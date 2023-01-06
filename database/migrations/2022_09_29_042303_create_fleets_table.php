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
        Schema::create('fleets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organisation_id')->nullable();
            $table->uuid('uuid')->nullable();
            $table->string('image')->nullable(); 
            $table->string('mega_discription')->nullable(); 
            $table->unsignedBigInteger('is_reserved')->default(0)->comment(' 0 = available, 1 = booked');
            $table->string('features')->nullable();
            $table->string('booking_conditions')->nullable();   
			$table->string('insurance_provider')->nullable();    
		    $table->date('insurance_Expire_date')->format('d/m/Y')->nullable();  
            $table->string('documents')->nullable();
            $table->string('documents2')->nullable();
            $table->string('documents3')->nullable();
            $table->string('documents4')->nullable();
            $table->integer('type')->nullable(); 
            $table->string('car_SKU')->nullable(); 
            $table->string('car_year')->nullable();
            $table->integer('car_service_type')->nullable(); 
            $table->string('car_color')->nullable();
            $table->string('car_number')->nullable(); 
            $table->string('car_chasis_number')->nullable(); 
            $table->string('fleet_size')->nullable();
            $table->enum('status', ['1', '2'])->default('1')->comment('1:active, 2:inactive');
            $table->string('allowed_distance')->nullable(); 
            $table->string('unit')->nullable(); 
            $table->string('child_seat')->nullable(); 
            $table->string('insurence')->nullable(); 
            $table->string('additional_distance')->nullable(); 
            $table->string('owner_name')->nullable();
            $table->string('phone')->nullable(); 
            $table->string('email')->nullable(); 
            $table->string('billing_email')->nullable();               
            $table->foreign('organisation_id')->references('id')->on('organisations')->nullable();
            $table->unsignedBigInteger('created_user')->nullable();
            $table->unsignedBigInteger('updated_user')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('is_deleted')->default(0)->comment(' 0 = not_deleted, 1 = deleted');
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
        Schema::dropIfExists('fleets');
    }
};
