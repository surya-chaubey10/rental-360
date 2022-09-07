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
        Schema::create('offer_partners', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid'); 
            $table->string('partner_name')->nullable();  
            $table->unsignedBigInteger('organisation_id')->default(1);  
            $table->foreign('organisation_id')->references('id')->on('organisations');
            $table->boolean('status')->default(1); 
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
        Schema::dropIfExists('offer_partners');
    }
};
