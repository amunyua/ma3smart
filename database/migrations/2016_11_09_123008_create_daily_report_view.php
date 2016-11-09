<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateDailyReportView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement(
            "CREATE OR REPLACE VIEW daily_report_view AS
                SELECT dt.id,
                  dt.transaction_date,
                  dt.bus_id,
                  dt.driver_id,
                  dt.conductor_id,
                  dt.total_amount_collected,
                  dt.total_trips,
                  de.expense_id,
                  de.amount,
                  dba.actual_banked
                
                
                FROM daily_transactions dt
                LEFT JOIN daily_expenses de ON de.transaction_id = dt.id
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
        DB::statement("DROP VIEW daily_report_view");
    }
}
