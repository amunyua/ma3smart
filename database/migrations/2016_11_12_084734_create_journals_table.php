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
            $table->integer('bus_id');
//            $table->foreign('bus_id')
//                ->references('id')
//                ->on('buses');
            $table->string('dr_cr')->nullable();
            $table->string('service_account')->nullable();
            
            $table->string('particulars')->nullable();
//            $table->dateTime('journal_date')->default(time());
            $table->integer('transacted_by');
            $table->string('transaction_type')->nullable();
            $table->float('amount');
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
