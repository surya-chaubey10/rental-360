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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('organisation_id')->default(1);
            $table->dateTime('from_date')->nullable();
            $table->dateTime('to_date')->nullable();
            $table->string('promotion_code')->nullable(); 
            $table->unsignedBigInteger('status')->default(1)->comment('Like 0 = Active, 1 = Inactive'); 
            $table->string('promotion_type')->nullable(); 
            $table->string('promotion_value')->nullable(); 
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
        Schema::dropIfExists('coupons');
    }
};
