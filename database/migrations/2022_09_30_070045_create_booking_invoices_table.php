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
        Schema::create('booking_invoices', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid'); 
            $table->unsignedBigInteger('booking_id');
            $table->string('document_type');
            $table->unsignedBigInteger('organisation_id')->default(1);  
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('currency_type')->nullable();
            $table->string('transaction_type')->nullable();
            $table->string('customer_ref')->nullable();
            $table->string('invoice_ref')->nullable();
            $table->string('phone')->nullable();
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('trans_ref')->nullable();
            $table->string('inv_description')->nullable();
            $table->string('short_link');
            $table->unsignedBigInteger('promotion_id')->default(0);
             $table->unsignedBigInteger('is_adjust_invoice')->default(0);
            $table->decimal('promotion_value ')->default(0.000);

            $table->decimal('subtotal')->default(0.000);
            $table->decimal('subtotal_discount')->default(0.000);
            $table->decimal('delivery_charge')->default(0.000);
            $table->decimal('grand_total')->default(0.000);
            
            $table->string('create_user')->nullable();
            $table->string('updated_user')->nullable(); 
            $table->boolean('status')->default(1);

            $table->foreign('organisation_id')->references('id')->on('organisations');
            $table->foreign('booking_id')->references('id')->on('manage_bookings');

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
        Schema::dropIfExists('booking_invoices');
    }
};
