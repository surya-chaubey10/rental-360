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
        Schema::create('general_ledgers', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable();
            $table->unsignedBigInteger('organisation_id')->nullable();
            $table->decimal('amount',18,3)->default(0.000);
            $table->decimal('credit',18,3)->default(0.000);
            $table->decimal('debit',18,3)->default(0.000);
            $table->integer('customer_id')->nullable();
            $table->integer('booking_id')->nullable();
            $table->integer('transaction_id')->nullable();
            $table->string('trans_ref',200)->nullable();
            $table->decimal('Balance',18,3)->default(0.000);
            $table->decimal('commision',18,3)->default(0.000);
            $table->decimal('pgcharges',18,3)->default(0.000);
            $table->integer('fixed_fee')->default(1)->nullable();
            $table->integer('partial_amount')->nullable();
            $table->decimal('vat',18,3)->default(0.000);
            $table->enum('is_transfer', [1, 2])->default(1)->nullable();
            $table->unsignedBigInteger('invoice_id')->nullable();
            $table->enum('cash_collected', [1, 2])->nullable();
            $table->unsignedBigInteger('type', [1, 2, 3])->default(1)->nullable()->comment('1=Transfer From Pending,2=Pay Out, 3=Partially payment');
            $table->integer('withdrawal_fee')->nullable();
            $table->integer('account_payment_id')->nullable();
            $table->string('document_type ')->nullable();
            $table->string('image',250)->nullable();
            $table->string('note',250)->nullable();
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
        Schema::dropIfExists('general_ledgers');
    }
};
