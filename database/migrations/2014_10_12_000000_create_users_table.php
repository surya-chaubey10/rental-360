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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('organisation_id')->nullable();
            $table->unsignedBigInteger('usertype')->default(1)->comment('0:superadmin, 1:admin (organisation), 2:customer, 3:salesman..., we\'ll add all the users type after confirmation');
            $table->string('parent_id')->nullable()->comment('If the user type is admin then put the admin id here to make it as a group.');
            $table->string('fullname')->index();
            $table->string('username')->index();
            $table->string('email')->unique()->index();
            $table->string('password');
            $table->string('api_token')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('mobile')->nullable();
            $table->integer('country_id')->nullable();
            $table->boolean('is_approved_by_admin')->default(1);
            $table->boolean('status')->default(1);
            $table->enum('login_type', ['system', 'google', 'facebook', 'twitter', 'mobile']);
            $table->integer('role_id')->default(2)->comment('1:superadmin, 2 org-admin, 3...');
            // $table->foreign('organisation_id')->references('id')->on('organisations')->onDelete('cascade');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
