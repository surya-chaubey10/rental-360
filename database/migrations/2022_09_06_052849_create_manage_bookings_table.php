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
        Schema::create('manage_bookings', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->dateTime('pickup_date_time')->nullable();
            $table->dateTime('dropoff_date_time')->nullable(); 
            $table->unsignedBigInteger('vehicle_id')->nullable();
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->unsignedBigInteger('number_of_tavellers')->nullable(); 
            $table->unsignedBigInteger('organisation_id')->default(1);
            $table->string('pickup_address')->nullable();;
            $table->string('dropoff_address')->nullable(); 
            $table->string('note')->nullable();  
            $table->string('add_field_name')->nullable(); 
            $table->string('added_field_data')->nullable(); 
            $table->foreign('organisation_id')->references('id')->on('organisations');
            $table->unsignedBigInteger('created_user')->nullable(); 
            $table->unsignedBigInteger('updated_user')->nullable(); 
            $table->timestamps();
            // $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manage_bookings');
    }
};
