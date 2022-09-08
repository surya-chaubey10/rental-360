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
        Schema::create('offer_packages', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('organisation_id')->default(1);
            $table->string('package_name');
            $table->string('package_price');
            $table->string('days_limit');
            $table->string('term_condition');
            $table->string('offer_image');
            $table->unsignedBigInteger('zero_deposit')->nullable();
            $table->string('discount_precentage');
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
        Schema::dropIfExists('offer_packages');
    }
};
