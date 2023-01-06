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
        Schema::create('charge_amounts', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable();
            $table->unsignedBigInteger('user_id')->default(0);
            $table->unsignedBigInteger('organisation_id')->default(1);
            $table->unsignedBigInteger('transection_id');
            $table->unsignedBigInteger('booking_id')->default(0);
            $table->unsignedBigInteger('invoice_id')->default(0); 
            $table->string('full_name');  
            $table->string('email'); 
            $table->string('tran_type')->nullable();
            $table->string('tran_ref')->nullable();
            $table->string('cart_id')->nullable();
            $table->string('currency')->nullable(); 
            $table->decimal('charge_amount')->default('0.00');  
            $table->decimal('total_amount')->default('0.00');          
            $table->text('reason_description')->nullable(); 
            $table->string('token')->nullable();
            $table->string('supporting_document')->nullable();
            $table->foreign('organisation_id')->references('id')->on('organisations');
            $table->enum('status', [0, 1])->default(0)->comment('0 ON Pending, 1 On Paid');
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
        Schema::dropIfExists('charge_amounts');
    }
};
