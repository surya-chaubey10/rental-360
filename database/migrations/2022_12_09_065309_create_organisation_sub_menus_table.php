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
        Schema::create('organisation_sub_menus', function (Blueprint $table) {
            $table->id();

            $table->uuid('uuid')->nullable();
            $table->unsignedBigInteger('organisation_id')->nullable();

            $table->unsignedBigInteger('organisation_menu_id')->nullable();

            $table->unsignedBigInteger('admin_sub_menu_id')->nullable();


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
        Schema::dropIfExists('organisation_sub_menus');
    }
};
