<?php

namespace App\Http\Controllers;

use App\Bus;
use App\CustomerBills;
use App\InvoiceTransactionDetails;
use App\InvoiceTransactions;
use App\Journal;
use App\Supplier;
use App\SupplierEntity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getSuppliers(){
        $suppliers = Supplier::all();
        return view('suppliers.suppliers',array(
            'suppliers'=>$suppliers
        ));
    }

    public function storeSupplier(Request $request){
        var_dump($_POST);
        $this->validate($request,array(
            'supplier_name'=>'required|unique:suppliers,supplier_name',
            'role'=>'required',
            'code'=>'required|unique:suppliers,code',
            'phone_number'=>'required',
            'city'=>'required',
            'physical_location'=>'required'
        ));

        $supplier = new Supplier();
        $supplier->supplier_name = ucfirst($request->supplier_name);
        $supplier->code = strtoupper($request->code);
        $supplier->role = $request->role;
        $supplier->phone_number = $request->phone_number;
        $supplier->registration_number = $request->registration_number;
        $supplier->city = $request->city;
        $supplier->physical_location = $request->physical_location;
        $supplier->created_by = $this->user()->id;
        $supplier->save();

        Session::flash('success','Supplier('.$request->supplier_name.') has been added');
        return redirect('suppliers');
    }

    public function getSupplierItems(){
        $supplier_items = SupplierEntity::all();
        $suppliers = Supplier::where('status',true)->get();
        return view('suppliers.supplier-entities',array(
            'suppliers'=>$suppliers,
            'supplier_items'=>$supplier_items
        ));
    }

    public function storeSupplierItem(Request $request){
        $this->validate($request,array(
            'supplier_id'=>'required',
            'item_name'=>'required|unique:supplier_entities,item_name',
            'item_code'=>'required|unique:supplier_entities,item_code',
            'amount'=>'required'
        ));

        $supplier_item = new SupplierEntity();
        $supplier_item->supplier_id = $request->supplier_id;
        $supplier_item->item_name = $request->item_name;
        $supplier_item->item_code = $request->item_code;
        $supplier_item->amount = $request->amount;
        $supplier_item->created_by = $this->user()->id;
        $supplier_item->save();

        Session::flash('success','Supplier item ('.$request->item_name.') has been added');
        return redirect('supplier-items');
    }

    public function getInvoices(){
        $transactions = InvoiceTransactions::all();
        $vehicles = Bus::all();
        $suppliers = Supplier::where('status',true)->get();
        return view('suppliers.raise-invoice',array(
            'suppliers'=>$suppliers,
            'vehicles'=>$vehicles,
            'transactions'=>$transactions
        ));
    }

    public function loadInvoiceFields($id){

        if($id != 0){
            $supplier_items = SupplierEntity::where([
                ['status',true],
                ['supplier_id',$id]
            ])->get();
            return Response::json($supplier_items);
        }
    }

    public function createInvoice(Request $request){
//        print_r($_POST);
        $this->validate($request, array(
            'supplier_id'=>'required',
            'invoice_date'=>'required',
            'vehicle_id'=>'required'
        ));

        DB::transaction(function () {
            $invoice_transaction = new InvoiceTransactions();
            $invoice_transaction->vehicle_id = Input::get('vehicle_id');
            $invoice_transaction->transaction_date = Input::get('invoice_date');
            $invoice_transaction->supplier_id = Input::get('supplier_id');
            $invoice_transaction->save();
            $transaction_id = $invoice_transaction->id;
            $supplier_items = array();
//            print_r($supplier_items);
            foreach ($_POST as $key => $post) {
                if (is_numeric($key)) {
                    $supplier_items[] = array(
                        'supplier_item' => $key,
                        'amount' => $post
                    );
                }
            }
            if(count($supplier_items)){
                $total_invoice_amount = 0;
                foreach ($supplier_items as $supplier_item) {
                    $total_invoice_amount= $total_invoice_amount + $supplier_item['amount'];
                    $transaction_details = new InvoiceTransactionDetails();
                    $transaction_details->invoice_transaction_id = $transaction_id;
                    $transaction_details->item_id = $supplier_item['supplier_item'];
                    $transaction_details->amount = $supplier_item['amount'];
                    $transaction_details->save();
                }
            }
            //create a customer bill\
            $customer_bill = new CustomerBills();
            $customer_bill->bill_amount = $total_invoice_amount;
            $customer_bill->invoice_id = $transaction_id;
            $customer_bill->bill_date = Input::get('invoice_date');
            $customer_bill->bill_amount_paid = 0;
            $customer_bill->bill_balance = $total_invoice_amount;
            $customer_bill->bus_id = Input::get('vehicle_id');
            $customer_bill->total_cash_received = 0;
            $customer_bill->save();
            $bill_id = $customer_bill->id;

        });
        Session::flash('success','Invoice has been generated');
        return redirect('invoices');
    }

    public function destroySupplier($id){
        $supplier = Supplier::find($id);
        $supplier->delete();
        Session::flash('success','The supplier has been deleted');
        return redirect('suppliers');
    }

    public function deleteSuppE($id){
        $del_id = SupplierEntity::find($id);
        $del_id->delete();
        Session::flash('success','Supplier item deleted');
        return redirect('supplier-items');
    }

    public function deleteInvoice($id){
        $del_id = InvoiceTransactions::find($id);
        $del_id->delete();
        Session::flash('success','The invoice has been deleted');
        return redirect('invoices');
    }

    public function loadInvoiceBillDetails($id){
        $results = CustomerBills::where('invoice_id',$id)->first();
        return Response::json($results);
    }

    //function to proccess paybill
    private $_id;

    public function payBill(Request $request, $id){
        $this->_id = $id;
        $transaction = DB::transaction(function (){
            $customer_bill = CustomerBills::where('invoice_id',$this->_id)->first();
            $new_bill_amount_paid = $customer_bill->bill_amount_paid + Input::get('amount_paid');
            $new_bill_balance = ($customer_bill->bill_amount - $new_bill_amount_paid);
//            echo $new_bill_balance;die;
            //update the bill details
            $pay_bill = DB::table('customer_bills')
            ->where('invoice_id', $this->_id)
            ->update(['bill_amount_paid' => $new_bill_amount_paid,'bill_balance'=>$new_bill_balance ]);
//            ->update(['bill_balance'=>$new_bill_balance ]);

            //insert journal
            $journal = new Journal();
            $journal->bus_id = $customer_bill->bus_id;
            $journal->amount = Input::get('amount_paid');
            $journal->dr_cr = 'DB';
            $journal->bill_id = $customer_bill->id;
            $journal->particulars = 'Paid invoice number '.$this->_id;
            $journal->status = true;
            $journal->save();


        });

            Session::flash('success','Bill amount ('.$request->amount_paid.') has been paid successfully');

        return redirect('invoices');
    }
}

