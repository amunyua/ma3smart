<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
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
            ->where('transaction_id',$id)
            ->get();
        return view('reports.daily-report',array(
            'daily_reports'=>$daily_reports
        ));
    }

    public function viewAllTransactionsReport(){
        $reports =DB::table('on_demand_daily_report')->get();
        return view('reports.on-demand-report',array(
            'reports'=>$reports
        ));
    }
}
