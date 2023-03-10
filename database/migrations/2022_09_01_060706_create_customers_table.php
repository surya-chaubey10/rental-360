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

            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('organisation_id')->default(1);
            $table->date('dob')->format('d/m/Y')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('website')->nullable();
            $table->string('image')->nullable();
            $table->string('language')->nullable();
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
            $table->enum('contact_option', ['email', 'message', 'phone'])->nullable();
            $table->enum('approval_status', ['Active', 'Inacive', 'Pending'])->default('Pending');
            $table->boolean('status')->default(1);

            $table->foreign('organisation_id')->references('id')->on('organisations');
            $table->unsignedBigInteger('created_user')->nullable();
            $table->unsignedBigInteger('updated_user')->nullable();
            $table->timestamps();
            $table->softDeletes();
			$table->enum('is_deleted', [0, 1])->default(0);
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
