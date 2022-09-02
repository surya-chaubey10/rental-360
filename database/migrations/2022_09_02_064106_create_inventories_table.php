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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('brand_name');
            $table->string('model_name');
            $table->string('inventory_type')->nullable();
            $table->string('img');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('organisation_id')->default(1);
            $table->enum('status', ['1', '2'])->default('1')->comment('1:enable, 2:disable');
            //$table->foreign('organisation_id')->references('id')->on('organisations');
           
            $table->rememberToken();
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
        Schema::dropIfExists('inventories');
    }
};
