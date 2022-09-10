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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('organisation_id')->default(1);
            $table->string('vehicle_image');
            $table->string('vehicle_details_image');
            $table->text('vehicle_description');
            
            $table->string('vehicle_name');
            $table->unsignedBigInteger('vehicle_category')->nullable();
            $table->unsignedBigInteger('vehicle_type')->nullable();
            $table->unsignedBigInteger('vehicle_brand')->nullable();
            $table->unsignedBigInteger('vehicle_features')->nullable();
            $table->unsignedBigInteger('vehicle_service_type')->nullable();
            $table->enum('status', ['1', '2'])->default('1')->comment('1:enable, 2:disable');
            $table->enum('approval_status', ['Active', 'Inacive', 'Pending'])->default('Pending');
            
            $table->unsignedBigInteger('make_year')->nullable();
            $table->unsignedBigInteger('day1_to_day3')->nullable();
            $table->unsignedBigInteger('day3_to_day10')->nullable();
            $table->unsignedBigInteger('day10_to_day30')->nullable();
            $table->unsignedBigInteger('drop_price')->nullable();
            $table->unsignedBigInteger('half_day_price')->nullable();
            $table->unsignedBigInteger('full_day_price')->nullable();
            $table->unsignedBigInteger('extra_hourly_price')->nullable();
            $table->unsignedBigInteger('no_of_seats')->nullable();
            $table->unsignedBigInteger('no_of_doors')->nullable();
            $table->unsignedBigInteger('contact_option')->nullable();

            $table->unsignedBigInteger('created_user')->nullable();
            $table->unsignedBigInteger('updated_user')->nullable();
            $table->foreign('organisation_id')->references('id')->on('organisations');
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
        Schema::dropIfExists('vehicles');
    }
};
