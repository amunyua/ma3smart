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
            $table->increments('id');
            $table->float('bill_amount');
            $table->dateTime('bill_date');
            $table->float('bill_amount_paid');
            $table->float('bill_balance');
            $table->integer('bus_id');
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
