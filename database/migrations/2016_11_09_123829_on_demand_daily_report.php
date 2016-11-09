<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class OnDemandDailyReport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement(
          "CREATE OR REPLACE VIEW on_demand_daily_report as 
            SELECT dt.id,
                dt.transaction_date,
                dt.bus_id,
                dt.driver_id,
                dt.conductor_id,
                dt.total_amount_collected,
                dt.total_trips,
                dba.actual_banked
            
              FROM daily_transactions dt
                LEFT JOIN daily_bank_accumulations dba ON dba.transaction_id = dt.id
            
            "
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW on_demand_daily_report");
    }
}
