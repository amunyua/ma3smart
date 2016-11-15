<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJournalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bus_id')->nullable();
            $table->float('amount');
            $table->string('dr_cr');
            $table->integer('bill_id')->unsigned()->index()->nullable();
            $table->foreign('bill_id')
                ->references('customer_bills')
                ->on('id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('particulars')->nullable();
            $table->integer('daily_transaction_id')->nullable()->unsigned()->index();
            $table->foreign('daily_transaction_id')
                ->references('id')
                ->on('daily_transactions')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->boolean('status')->dafault(true);

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
        Schema::dropIfExists('journals');
    }
}
