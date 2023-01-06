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
        Schema::create('amount_transactions', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid'); 
            $table->unsignedBigInteger('organisation_id')->default(1);
            $table->unsignedBigInteger('invoice_id');
            $table->string('transaction_ref')->nullable();
            $table->string('name')->nullable();
            $table->string('type')->nullable()->comment('Like 1 = sales');
            $table->unsignedBigInteger('payment_method')->nullable()->comment('Like 1 = visa/mastercard, 2 = amex'); 
            $table->decimal('amount')->default(0.000); 
            $table->boolean('status')->default(1)->comment('Like 1 = Active, 2 = Inactive');
            $table->enum('transaction_status',[0,1,2])->default(1)->comment('Like 0 = Inactive, 1 = Active, 2 = Payment Successful');
            $table->unsignedBigInteger('created_user')->nullable(); 
            $table->unsignedBigInteger('updated_user')->nullable(); 
            $table->foreign('organisation_id')->references('id')->on('organisations');
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
        Schema::dropIfExists('amount_transactions');
    }
};
