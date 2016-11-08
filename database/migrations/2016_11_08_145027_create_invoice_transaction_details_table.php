<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceTransactionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_transaction_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('invoice_transaction_id')->unsigned()->index();
            $table->foreign('invoice_transaction_id')
                ->references('id')
                ->on('invoice_transactions')
                ->onUpdate('cascade');
            $table->integer('item_id')->unsigned()->index();
            $table->foreign('item_id')
                ->references('id')
                ->on('supplier_entities')
                ->onUpdate('cascade');
            $table->double('amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_transaction_details');
    }
}
