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
            $table->string('booking_code')->nullable(); 
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->dateTime('pickup_date_time')->nullable();
            $table->dateTime('dropoff_date_time')->nullable(); 
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->unsignedBigInteger('vehicle_id')->nullable();
            $table->unsignedBigInteger('model_id')->nullable();
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->unsignedBigInteger('number_of_tavellers')->nullable(); 
            $table->unsignedBigInteger('organisation_id')->default(1);
            $table->unsignedBigInteger('is_created_invoice')->default(0)->comment('Like 0 = pending, 1 = created');
            $table->unsignedBigInteger('is_send_invoice')->default(0)->comment('Like 0 = pending, 1 = sent');
            $table->string('pickup_address')->nullable();
            $table->string('agent_details')->nullable();
            $table->string('dropoff_address')->nullable(); 
            $table->string('note')->nullable();  
            $table->string('invoice_preview_note')->nullable();  
            $table->unsignedBigInteger('dispatch_type');  
            $table->string('merchant_name')->nullable();  
            $table->string('merchant_phone')->nullable();  
            $table->unsignedBigInteger('merchant_sku')->nullable(50);  
            $table->string('add_field_name')->nullable(); 
            $table->string('added_field_data')->nullable(); 
            $table->decimal('amount',18,3)->default(0.000); 
            $table->dateTime('extend_date')->nullable();
            $table->foreign('organisation_id')->references('id')->on('organisations');
            $table->unsignedBigInteger('payment_mode')->nullable()->comment('Like 1 = visa/mastercard, 2 = amex'); 
            $table->unsignedBigInteger('status')->default(1)->comment('Like 1 = pending, 2 = paid'); 
            $table->unsignedBigInteger('booking_status')->default(1)->comment('Like 1 = upcoming, 2 = closed, 3 = cancel'); 
            $table->unsignedBigInteger('created_user')->nullable(); 
            $table->unsignedBigInteger('updated_user')->nullable(); 
            $table->timestamps();
            $table->softDeletes();  

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
