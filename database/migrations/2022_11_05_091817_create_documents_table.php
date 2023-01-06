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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable();
            $table->unsignedBigInteger('organisation_id')->default(1);
            $table->unsignedBigInteger('company_kyc_id')->nullable();
            //owner tab
            $table->enum('ow_doc_type1_status', ['1', '2'])->comment('1:Approved, 2:Rejected')->nullable();
            $table->enum('ow_doc_type2_status', ['1', '2'])->comment('1:Approved, 2:Rejected')->nullable();
            $table->enum('ow_doc_type3_status', ['1', '2'])->comment('1:Approved, 2:Rejected')->nullable();
            $table->enum('ow_doc_type4_status', ['1', '2'])->comment('1:Approved, 2:Rejected')->nullable();

            //bussiness tab
            $table->enum('bu_doc_type1_status', ['1', '2'])->comment('1:Approved, 2:Rejected')->nullable();
            $table->enum('bu_doc_type2_status', ['1', '2'])->comment('1:Approved, 2:Rejected')->nullable();
            $table->enum('bu_doc_type3_status', ['1', '2'])->comment('1:Approved, 2:Rejected')->nullable();
            $table->enum('bu_doc_type4_status', ['1', '2'])->comment('1:Approved, 2:Rejected')->nullable();
            //others tab
            $table->enum('ot_doc_type1_status', ['1', '2'])->comment('1:Approved, 2:Rejected')->nullable();
            $table->enum('ot_doc_type2_status', ['1', '2'])->comment('1:Approved, 2:Rejected')->nullable();
            $table->enum('ot_doc_type3_status', ['1', '2'])->comment('1:Approved, 2:Rejected')->nullable();
            $table->enum('ot_doc_type4_status', ['1', '2'])->comment('1:Approved, 2:Rejected')->nullable();

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
        Schema::dropIfExists('documents');
    }
};
