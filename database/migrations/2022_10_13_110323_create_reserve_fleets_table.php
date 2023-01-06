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
        
        Schema::create('reserve_fleets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organisation_id');
            $table->BigInteger('fleet_id');
            $table->BigInteger('model_id');
            $table->BigInteger('brand_id');
            $table->BigInteger('booking_id')->nullable();
            $table->string('car_SKU');
            $table->string('from_date');
            $table->string('to_date');
            $table->foreign('organisation_id')->references('id')->on('organisations');
            $table->foreign('fleet_id')->references('id')->on('fleets');
            $table->foreign('model_id')->references('id')->on('models');
            $table->foreign('brand_id')->references('id')->on('vehicle_brands');
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
        Schema::dropIfExists('reserve_fleets');
    }
};
