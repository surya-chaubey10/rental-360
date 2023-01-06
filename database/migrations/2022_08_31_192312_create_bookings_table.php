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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable();
            $table->unsignedBigInteger('organisation_id')->default(1);
            $table->string('name')->nullable(); 
            $table->string('phone')->nullable(); 
            $table->string('customeremail')->nullable(); 
            $table->string('fromdate')->nullable(); 
            $table->string('todate')->nullable(); 
            $table->string('pickup')->nullable(); 
            $table->string('dropoff_address')->nullable(); 
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->string('destination')->nullable(); 
            $table->string('bookingMake')->nullable(); 
            $table->string('bookingModel')->nullable(); 
            $table->string('inlineRadioOptions')->nullable(); 
            $table->string('merchantname')->nullable(); 
            $table->string('contact')->nullable();
            $table->string('amount')->nullable(); 
            $table->string('paymentmode')->nullable(); 
            $table->text('note')->nullable();    
            $table->boolean('status')->default(1);
            $table->unsignedBigInteger('booking_status')->default(1)->comment('Like 1 = upcoming, 2 = closed, 3 = cancel');     
            $table->foreign('organisation_id')->references('id')->on('organisations');
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
        Schema::dropIfExists('bookings');
    }
};
