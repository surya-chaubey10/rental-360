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
        Schema::create('subscription_modules', function (Blueprint $table) {
            $table->id();

            $table->uuid('uuid')->nullable();
            $table->unsignedBigInteger('subcription_id')->nullable();
            $table->unsignedBigInteger('admin_menu_id')->nullable();
            $table->foreign('subcription_id')->references('id')->on('subscription_plans')->onDelete('cascade');
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
        Schema::dropIfExists('subscription_modules');
    }
};
