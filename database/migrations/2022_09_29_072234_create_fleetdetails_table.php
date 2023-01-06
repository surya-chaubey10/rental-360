<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fleetdetails', function (Blueprint $table) {
            $table->id();
            $table->integer('fleet_id')->nullable();
            $table->string('material')->nullable();
            $table->string('deposit')->nullable();
            $table->string('unit_price')->nullable();
            $table->string('discount')->nullable(); 
            $table->string('vat')->nullable(); 
            $table->string('minimum')->nullable(); 
            $table->string('subtotal')->nullable(); 
            $table->unsignedBigInteger('created_user')->nullable();
            $table->unsignedBigInteger('updated_user')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fleetdetails');
    }
};
