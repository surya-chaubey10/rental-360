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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('menu_navigation_id');
            $table->string('name')->index();
            $table->string('class')->nullable();
            $table->integer('badge')->nullable();
            $table->string('icon')->nullable();
            $table->string('slug')->nullable();
            $table->integer('position')->index();
            $table->boolean('status')->default(1);
            $table->timestamps();

            // $table->foreign('navigation_id')->references('id')->on('menu_navigations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
};
