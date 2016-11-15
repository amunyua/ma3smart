<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConsta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('invoice_transaction_details', function (Blueprint $table) {
//            $table->foreign('invoice_transaction_id')
//                ->references('id')
//                ->on('invoice_transactions')
//                ->onDelete('cascade');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoice_transactions', function (Blueprint $table) {
            //
        });
    }
}
