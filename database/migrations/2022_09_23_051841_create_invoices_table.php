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
        Schema::create('tbl_invoice_header', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('booking_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('organisation_id')->default(1);
            $table->unsignedBigInteger('full_name');
            $table->unsignedBigInteger('email');
            $table->string('currency');
            $table->string('transaction_type');
            $table->string('customer_ref');
            $table->string('invoice_ref');
            $table->unsignedBigInteger('phone');
            $table->string('street');
            $table->string('city');
            $table->unsignedBigInteger('country');
            $table->string('state');
            $table->string('zip');
            $table->string('discription');
            $table->decimal('sub_total');
            $table->decimal('discount');
            $table->decimal('extra_charge');
            $table->decimal('shipping_charge');
            $table->decimal('grand_total');
            $table->unsignedBigInteger('created_user')->nullable();
            $table->unsignedBigInteger('updated_user')->nullable();
            $table->enum('status', ['1', '2'])->default('1')->comment();  
            $table->foreign('organisation_id')->references('id')->on('organisations');
            $table->foreign('booking_id')->references('id')->on('manage_bookings');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists( 'tbl_invoice_header');
    }
};
