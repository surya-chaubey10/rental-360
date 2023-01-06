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
        Schema::create('superadmin_roles', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('role_name')->nullable();
            $table->unsignedBigInteger('status')->default(1)->comment('Like 1= Active, 2= Inactive'); 
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
        Schema::dropIfExists('superadmin_roles');
    }
};
