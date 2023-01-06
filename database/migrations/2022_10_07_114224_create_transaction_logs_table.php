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
        Schema::create('transaction_logs', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid'); 
            $table->unsignedBigInteger('organisation_id')->default(1);
            $table->unsignedBigInteger('invoice_id');
            $table->string('name')->nullable();
            $table->string('amount')->nullable(); 
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
        Schema::dropIfExists('transaction_logs');
    }
};
