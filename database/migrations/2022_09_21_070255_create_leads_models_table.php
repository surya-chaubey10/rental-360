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
        Schema::create('leads_models', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('organisation_id')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->integer('mobile')->nullable();
            $table->string('email')->nullable();
            $table->unsignedBigInteger('source')->nullable();
            $table->unsignedBigInteger('assigned')->nullable();
            $table->integer('status')->nullable();
            $table->string('tags')->nullable();
            $table->unsignedBigInteger('type')->nullable();
            $table->unsignedBigInteger('vehicle')->nullable();
            $table->unsignedBigInteger('model')->nullable();
            $table->date('from')->nullable();
            $table->date('to')->nullable();
            $table->string('note')->nullable();
            $table->string('twitter')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('github')->nullable();
            $table->string('codepen')->nullable();
            $table->string('slack')->nullable();
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
        Schema::dropIfExists('leads_models');
    }
};
