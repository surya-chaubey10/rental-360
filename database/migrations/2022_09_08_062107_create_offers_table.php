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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('organisation_id')->default(1);
            $table->unsignedBigInteger('offer_category_id');
            $table->unsignedBigInteger('vehicle_id');
            $table->string('startdate');
            $table->string('enddate');
            $table->string('starttime');
            $table->string('endtime');
            $table->unsignedBigInteger('discount_type');
            $table->string('offer_image');
            $table->string('minimun_value');
            $table->string('maximum_value');
            $table->unsignedBigInteger('created_user')->nullable();
            $table->unsignedBigInteger('updated_user')->nullable();
            $table->enum('status', ['1', '2'])->default('1')->comment('1:enable, 2:disable');
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
        Schema::dropIfExists('offers');
    }
};
