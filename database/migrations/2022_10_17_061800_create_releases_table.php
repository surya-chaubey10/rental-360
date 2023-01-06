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
        Schema::create('releases', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('organisation_id')->default(1);
            $table->unsignedBigInteger('request_id')->nullable();
            $table->string('company_name')->nullable();
            $table->decimal('withdraw_amount')->default(0.000);
            $table->decimal('withdraw_fees')->default(0.000);
            $table->string('request_on')->nullable();
            $table->date('last_approval_date')->nullable();
            $table->enum('status', ['1', '2'])->default('1')->comment('1:Approved, 2:Rejected');
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
        Schema::dropIfExists('releases');
    }
};
