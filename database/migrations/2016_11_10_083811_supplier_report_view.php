<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class SupplierReportView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        CREATE OR REPLACE VIEW supplier_report_view AS 
            SELECT it.id,
            it.vehicle_id,
              it.transaction_date,
              it.supplier_id,
              itd.item_id,
              itd.amount
            from invoice_transactions it
            LEFT JOIN invoice_transaction_details itd on itd.invoice_transaction_id = it.id
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW supplier_report_view");
    }
}
