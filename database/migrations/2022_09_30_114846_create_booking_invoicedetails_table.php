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
        Schema::create('booking_invoicedetails', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid'); 
            $table->unsignedBigInteger('invoice_id')->nullable();
            $table->unsignedBigInteger('organisation_id')->default(1);  
            $table->string('sku')->nullable();
            $table->string('description')->nullable();
            $table->decimal('price')->default(0.000);
            $table->string('period')->nullable();
            $table->string('discount')->nullable();
            $table->string('tax')->nullable();
            $table->decimal('total')->default(0.000);

            $table->string('agent')->nullable();
            $table->string('note')->nullable();
            $table->string('create_user')->nullable();
            $table->string('updated_user')->nullable(); 
            $table->boolean('status')->default(1);

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
        Schema::dropIfExists('booking_invoicedetails');
    }
};
