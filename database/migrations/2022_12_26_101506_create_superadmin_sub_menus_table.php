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
        Schema::create('superadmin_sub_menus', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('superadmin_menu_id')->nullable();
            $table->string('name')->nullable();
            $table->string('class')->nullable();
            $table->integer('badge')->nullable();
            $table->string('icon')->nullable();
            $table->string('url')->nullable();
            $table->integer('position')->nullable();
            $table->boolean('status')->default(1)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('superadmin_sub_menus');
    }
};
