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
        Schema::create('tbl_subscription_plans', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable();
            $table->unsignedBigInteger('organisation_id')->default(1);
            $table->string('plan_name')->nullable(); 
            $table->string('add_on_charge')->nullable(); 
            $table->string('deposit')->nullable(); 
            $table->unsignedBigInteger('convenience_fees_type')->default(1)->comment('Like 1 = flat, 2 = percentage, 3 = none'); 
            //$table->string('convenience_fees_type')->nullable(); 
            $table->string('convenience_fees_amount')->nullable(); 
            $table->unsignedBigInteger('commission_fees_type')->default(1)->comment('Like 1 = flat, 2 = percentage, 3 = none'); 
            //$table->string('commission_fees_type')->nullable(); 
            $table->string('commission_fees_amount')->nullable(); 
            $table->unsignedBigInteger('withdrawal_charges_add')->default(1)->comment('Like 1 = flat, 2 = percentage, 3 = none'); 
            //$table->string('withdrawal_charges_add')->nullable(); 
            $table->string('withdrawal_charges_amuont')->nullable();
            $table->string('visa_master_card')->nullable(); 
            $table->string('binance_pay')->nullable(); 
            $table->string('spotii')->nullable(); 
            $table->text('note')->nullable();    
            $table->unsignedBigInteger('status_type')->default(1)->comment('Like 1 = professional, 2 = rejected, 3 = resigned, 4 = applied , 5 = current');     
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
        Schema::dropIfExists('tbl_subscription_plans');
    }
};
