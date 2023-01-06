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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('organisation_id')->default(1);
            $table->date('date')->nullable();
            $table->string('vendor_name')->nullable();
            $table->decimal('current_balance')->default(0.000);
            $table->decimal('amount_request')->default(0.000);
            $table->decimal('balance_after_request')->default(0.000);
            $table->decimal('withdraw_fees')->default(0.000);
            $table->date('request_date')->nullable();
            $table->enum('status', ['1', '2'])->default('1')->comment('1:Approved, 2:Rejected');
            $table->enum('accepted', ['1', '2'])->comment('1:Approved, 2:Rejected')->nullable();
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
        Schema::dropIfExists('requests');
    }
};
