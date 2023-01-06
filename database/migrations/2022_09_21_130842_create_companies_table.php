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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable();
            $table->unsignedBigInteger('organisation_id')->nullable();

            $table->string('company_name');
            $table->string('company_logo');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('number');
            $table->string('pass');
            $table->string('website');
            $table->string('designation');
            $table->string('city');
            $table->unsignedBigInteger('country_id');
            $table->string('state');
            $table->string('zip');

            $table->foreign('country_id')->references('id')->on('country_masters')->onDelete('cascade');
            $table->foreign('organisation_id')->references('id')->on('organisations')->onDelete('cascade');
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
        Schema::dropIfExists('companies');
    }
};
