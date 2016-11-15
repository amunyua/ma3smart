<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_bills', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->float('bill_amount');
            $table->integer('invoice_id')->unsigned()
                ->index()->nullable();
            $table->foreign('invoice_id')
                ->references('id')
                ->on('invoice_transactions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->dateTime('bill_date');
            $table->float('bill_amount_paid')->nullable();
            $table->float('bill_balance');
            $table->integer('bus_id')->nullable();
            $table->float('total_cash_received')->nullable();
            $table->date('bill_due_date')->nullable();
            
            
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
        Schema::dropIfExists('customer_bills');
    }
}
