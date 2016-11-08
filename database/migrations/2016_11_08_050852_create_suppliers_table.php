<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->string('role',255);
            $table->string('supplier_name',255);
            $table->string('code',20);
            $table->integer('phone_number');
            $table->integer('registration_number')->nullable();
            $table->string('city')->nullable();
            $table->string('physical_location')->nullable();
            $table->boolean('status')->default(true);
            $table->integer('created_by');

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
        Schema::dropIfExists('suppliers');
    }
}
