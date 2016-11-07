<?php

namespace App\Http\Controllers;

use App\Bus;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class BusesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function getBuses(){
        $buses = Bus::all();
        return view('configurations.buses')->withBuses($buses);
    }

    public function storeBus(Request $request){
        $this->validate($request,array(
            'number_plate'=>'required|min:3|unique:buses,number_plate|min:7|max:7',
            'status'=>'required'
        ));
//        $this->logAction('add_user_role');
        $bus = new Bus();
        $bus->number_plate = strtoupper($request->number_plate);
        $bus->status = $request->status;

        $bus->save();
        Session::flash('success','Bus ('.strtoupper($request->number_plate).') has been added');
        return redirect('all-buses');
    }
}
