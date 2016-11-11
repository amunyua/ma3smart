<?php

namespace App\Http\Controllers;

use App\Masterfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getDailyReport(){
        $daily_reports = DB::table('daily_report_view')
            ->where('transaction_date',date('Y-m-d'))
            ->get();
        return view('reports.daily-report',array(
            'daily_reports'=>$daily_reports
        ));
    }

    public function viewDailyReport($id){
        $daily_reports = DB::table('daily_report_view')
            ->where('id',$id)
            ->get();
        return view('reports.daily-report',array(
            'daily_reports'=>$daily_reports
        ));
    }

    public function viewAllTransactionsReport(){
        $reports =DB::table('on_demand_daily_report')->get();
//        print_r($reports);
        $drivers = Masterfile::where('user_role','Driver')->get();
        return view('reports.on-demand-report',array(
            'reports'=>$reports,
            'drivers'=>$drivers
        ));
    }

    public function getSupplierReport($id){
        if(!empty($id)) {
            $reports = DB::table('supplier_report_view')
                ->where('id', $id)->get();
            return view('reports.supplier-report',array(
                'reports'=>$reports
            ));
        }
        return view('reports.supplier-report');
    }

    public function getFilteredData(Request $request){
        if(isset($request->date_range)){
            $data = explode('-',$request->date_range);
            echo $date1 = date('Y-d-m',strtotime($data[0]));
            echo $date2 = date('Y-d-m',strtotime($data[1]));
//            echo $date2 = $data[1];
            $reports = DB::table('on_demand_daily_report')
                ->whereBetween('transaction_date', [$date1, $date2])
                ->get();
            print_r($reports);
        }elseif (isset($request->driver_id)){
//            var_dump($_POST);
            $reports = DB::table('on_demand_daily_report')
                ->where('driver_id',$request->driver_id)
                ->get();
//            print_r($reports);
            $drivers = Masterfile::where('user_role','Driver')->get();
            return view('reports.on-demand-report',array(
                'reports'=>$reports,
                'drivers'=>$drivers
            ));
        }
    }
}
