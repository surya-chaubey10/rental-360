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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('organisation_id');
            $table->unsignedBigInteger('customer_id')->comment('comes from users table');
            $table->unsignedBigInteger('vehicle_id')->comment('comes from vehicle table');
            $table->unsignedBigInteger('driver_id')->comment('comes from driver table');
            $table->dateTime('picking_date_time');
            $table->dateTime('drop_off_date_time');
            $table->integer('no_of_travellers')->default(0);
            $table->text('pickup_address')->nullable();
            $table->text('drop_off_address')->nullable();
            $table->text('note')->nullable();

            $table->foreign('organisation_id')->references('id')->on('organisations');

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
        Schema::dropIfExists('bookings');
    }
};
