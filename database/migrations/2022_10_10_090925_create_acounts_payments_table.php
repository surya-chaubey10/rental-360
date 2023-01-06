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
        Schema::create('acounts_payments', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable();
            $table->unsignedBigInteger('organisation_id')->default(1);
            $table->string('full_name');  
            $table->enum('transaction_type', [1, 2, 3])->default(1)->comment('1 ON Sale, 2 On Pre Auth, 3 On Tokenize')->nullable();
            $table->string('transaction_ref')->nullable();
            $table->string('phone', 20)->nullable(); 
            $table->string('email')->nullable(); 
            $table->decimal('amount')->default('0.00');           
            $table->unsignedBigInteger('agent'); 
            $table->text('description')->nullable(); 
            $table->unsignedBigInteger('booking_id')->nullable();
            $table->unsignedBigInteger('invoice_id')->nullable(); 
            $table->text('comment')->nullable(); 
            $table->string('short_link')->nullable(); 
            $table->foreign('organisation_id')->references('id')->on('organisations');
            $table->foreign('booking_id')->references('id')->on('manage_bookings');
            $table->foreign('invoice_id')->references('id')->on('booking_invoices');
            $table->enum('status', [0, 1])->default(0)->comment('0 ON Pending, 1 On Paid');
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
        Schema::dropIfExists('acounts_payments');
        
        
    }
};
