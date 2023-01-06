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
        Schema::create('company_more_information', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('organisation_id')->default(1);
            
            $table->string('trn_number')->nullable();
            $table->string('office_address')->nullable();
            $table->string('city')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('profile_image')->nullable();

            //Api information
            $table->string('profile_id')->nullable();
            $table->string('server_key')->nullable();
            $table->string('company_prefix')->nullable();
            $table->unsignedBigInteger('account_type_id')->nullable();
            $table->unsignedBigInteger('currency_id')->nullable();

            $table->enum('company_profile', [1, 2])
            ->default(1)
            ->comment('1 = tokenise, 2 = normal')
            ->nullable();

            $table->unsignedBigInteger('packages_id')->nullable();
            $table->boolean('branded_pay_1')->comment('1= checked, 0= unckecked')->nullable();
            $table->boolean('branded_pay_2')->comment('1= checked, 0= unchecked')->nullable();

            $table->integer('withdraw_limit')->nullable();
            $table->integer('available_limit')->nullable();

            //SMS packages
            $table->string('sender_id')->nullable();
            $table->string('api_key')->nullable();
            $table->integer('sms_limit')->nullable();


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
        Schema::dropIfExists('company_more_information');
    }
};
