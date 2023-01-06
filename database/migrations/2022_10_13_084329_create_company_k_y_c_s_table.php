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
        Schema::create('company_k_y_c_s', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable();
            $table->unsignedBigInteger('organisation_id')->default(1);

            //owner tab
            $table->string('ow_document1')->nullable();
            $table->integer('ow_doc_type1')->nullable();

            $table->string('ow_document2')->nullable();
            $table->integer('ow_doc_type2')->nullable();

            $table->string('ow_document3')->nullable();
            $table->integer('ow_doc_type3')->nullable();

            $table->string('ow_document4')->nullable();
            $table->integer('ow_doc_type4')->nullable();


            //bussiness tab
            $table->string('bu_document1')->nullable();
            $table->integer('bu_doc_type1')->nullable();

            $table->string('bu_document2')->nullable();
            $table->integer('bu_doc_type2')->nullable();

            $table->string('bu_document3')->nullable();
            $table->integer('bu_doc_type3')->nullable();

            $table->boolean('tax_document_check_box')->comment('1: yes, 0: no')->nullable();

            $table->string('bu_document4')->nullable();
            $table->integer('bu_doc_type4')->nullable();

            $table->string('bu_document5')->nullable();
            $table->integer('bu_doc_type5')->nullable();



            //others tab
            $table->string('ot_document1')->nullable();
            $table->integer('ot_doc_type1')->nullable();

            $table->string('ot_document2')->nullable();
            $table->integer('ot_doc_type2')->nullable();

            $table->string('ot_document3')->nullable();
            $table->integer('ot_doc_type3')->nullable();

            $table->string('ot_document4')->nullable();
            $table->integer('ot_doc_type4')->nullable();

            
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
        Schema::dropIfExists('company_k_y_c_s');
    }
};
