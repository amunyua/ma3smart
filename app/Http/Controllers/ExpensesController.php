<?php

namespace App\Http\Controllers;

use App\Expense;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class ExpensesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function getExpenses(){
        $expenses = Expense::orderBy('id','desc')->get();
        return view('configurations.expenses')->withExpenses($expenses);
    }

    public function storeExpense(Request $request){
        $this->validate($request,array(
            'expense_name'=>'required|min:3|unique:expenses,expense_name|min:2',
            'amount'=>'required',
            'amount_type'=>'required',
            'code'=>'required|min:2|unique:expenses,code',
            'status'=>'required'
        ));
//        $this->logAction('add_user_role');
        $expense = new Expense();
        $expense->expense_name = ucfirst($request->expense_name);
        $expense->amount = $request->amount;
        $expense->status = $request->status;
        $expense->code = strtoupper($request->code);
        $expense->amount_type = $request->amount_type;

        $expense->save();
        Session::flash('success','Expense ('.ucfirst($request->expense_name).') has been added');
        return redirect('expenses');
    }
}
