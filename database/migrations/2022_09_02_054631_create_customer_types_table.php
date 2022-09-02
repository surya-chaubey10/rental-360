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
        Schema::create('customer_types', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('organisation_id')->default(1);
            $table->string('type_name');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->enum('approval_status', ['Active', 'Inacive', 'Pending'])->default('Pending');
            $table->boolean('status')->default(1);

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
        Schema::dropIfExists('customer_types');
    }
};
