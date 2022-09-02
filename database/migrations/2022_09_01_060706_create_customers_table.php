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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('fullname');
            $table->string('username');
            $table->string('email')->unique()->index();
            $table->string('contact')->nullable();
            $table->string('company')->nullable();;
            $table->unsignedBigInteger('country')->nullable();;
            $table->string('customer_type')->nullable();
            $table->date('dob')->format('d/m/Y')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('organisation_id')->default(1);
            $table->enum('status', ['1', '2','3'])->default('1')->comment('1:active, 2:inactive, 3:pending');
            $table->string('website')->nullable();
            $table->string('language')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->enum('contact_option', ['email', 'message','phone'])->nullable();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('postcode')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('twitter')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('github')->nullable();
            $table->string('codepen')->nullable();
            $table->string('stack')->nullable();
            $table->foreign('organisation_id')->references('id')->on('organisations');
          
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
        Schema::dropIfExists('customers');
    }
};
