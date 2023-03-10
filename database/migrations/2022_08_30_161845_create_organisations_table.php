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
        Schema::create('organisations', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('org_name');
            $table->string('org_company_id');
            $table->string('org_tax_id')->nullable();
            $table->string('org_street1');
            $table->string('org_street2')->nullable();
            $table->string('org_city')->nullable();
            $table->string('org_state')->nullable();
            $table->integer('org_country_id');
            $table->string('org_postal')->nullable();
            $table->string('org_phone');
            $table->string('org_contact_person')->nullable();
            $table->string('org_contact_person_number')->nullable();
            $table->string('password')->nullable();
            $table->string('org_currency')->default('USD');
            $table->string('org_fasical_year')->nullable();
            $table->string('gstin_number')->nullable();
            $table->boolean('is_batch_enabled')->default(0)->comment('if 1 then enabled batch module.');
            $table->boolean('is_credit_limit_enabled')->default(0)->comment('if 1 then enabled batch module.');
            $table->string('org_logo')->default('null');
            $table->string('designation')->nullable();
            $table->string('website')->nullable();
            $table->boolean('is_auto_approval_set')->default(0);
            $table->boolean('org_status')->default(1);
            $table->boolean('is_trial_period')->default(1);

            $table->boolean('agreement_status')->default(0)->comment('1 : Agreement done, 0 : Agreement not created');
            $table->integer('agreement_otp')->nullable();
            $table->boolean('is_mobile_verified')->default(0)->comment('1 : verified, 0 : not verified');
            $table->integer('mobile_otp')->nullable();
            $table->string('signature')->nullable();

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
       
    }
};
