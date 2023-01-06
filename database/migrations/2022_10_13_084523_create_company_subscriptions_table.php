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
        Schema::create('company_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('organisation_id')->default(1);
            
            $table->integer('billing_plan')->nullable();
            $table->string('add_on_charge')->nullable();
            $table->string('diposit')->nullable();

            $table->enum('convenience_type', [1, 2, 3])
            ->default(1)
            ->comment('1 = flat, 2 = percentage, 3 = none')
            ->nullable();

            $table->integer('convenience_amount')->nullable();

            $table->enum('commission_type', [1, 2, 3])
            ->default(1)
            ->comment('1 = flat, 2 = percentage, 3 = none')
            ->nullable();

            $table->integer('commission_amount')->nullable();

            $table->enum('withdrawal_type', [1, 2, 3])
            ->default(1)
            ->comment('1 = flat, 2 = percentage, 3 = none')
            ->nullable();

            $table->integer('withdrawal_amount')->nullable();

            $table->string('payment_gateway')
            ->comment('1 : visa/master, 2 : amex, 3 : Binance Pay, 4 : Spotii, 5 : Tabby')
            ->nullable();

            $table->string('payement_gateway_amount')->nullable();


            $table->date('billing_date')->nullable();

            $table->string('end_billing_date')->nullable();

            $table->boolean('auto_renewal')->comment('1: checked, 0: unchecked')->nullable();

            $table->text('description')->nullable();
            $table->boolean('include_description')->comment('1= on, 0= off')->nullable();

            $table->integer('currency')->comment('1: AED, 2: USD, 3: EURO')->nullable();
            $table->integer('vat')->nullable();;
            $table->integer('other')->nullable();;                   

            $table->text('term_condition')->nullable();

            $table->boolean('payout_setup')->comment('1= auto, 0= manual')->nullable();
            $table->string('time_cycle')->nullable();
            $table->string('payout_day')->nullable();



            $table->foreign('organisation_id')->references('id')->on('organisations')->onDelete('cascade');
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
        Schema::dropIfExists('company_subscriptions');
    }
};
