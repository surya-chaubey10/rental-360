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
        Schema::create('organisation_role_sub_menus', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('organisation_role_id');
            $table->unsignedBigInteger('organisation_role_menu_id');
            $table->unsignedBigInteger('menu_id');
            $table->unsignedBigInteger('sub_menu_id');
            $table->timestamps();

            // $table->foreign('organisation_role_id')->references('id')->on('organisation_roles');
            // $table->foreign('organisation_role_menu_id')->references('id')->on('organisation_role_menus');
            // $table->foreign('menu_id')->references('id')->on('menus');
            // $table->foreign('sub_menu_id')->references('id')->on('sub_menus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organisation_role_sub_menus');
    }
};