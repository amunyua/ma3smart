<?php

namespace App\Http\Controllers;

use App\Bus;
use App\InvoiceTransactionDetails;
use App\InvoiceTransactions;
use App\Supplier;
use App\SupplierEntity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class SupplierController extends Controller
{
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
            $supplier_items = SupplierEntity::where('status',true)->get();
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
            $transction_id = $invoice_transaction->id;
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
                foreach ($supplier_items as $supplier_item) {
                    $transaction_details = new InvoiceTransactionDetails();
                    $transaction_details->invoice_transaction_id = $transction_id;
                    $transaction_details->item_id = $supplier_item['supplier_item'];
                    $transaction_details->amount = $supplier_item['amount'];
                    $transaction_details->save();
                }
            }
        });
        Session::flash('success','Invoice has been generated');
        redirect('invoices');
    }
}
