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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid'); 
            $table->string('messages');
            $table->enum('read',[0,1])->default(0)->comment('Like 0 = Unread, 1 = Read');
            $table->enum('unread',[0,1])->default(1)->comment('Like 0 = Read, 1 = Unread');
            $table->unsignedBigInteger('organisation_id')->default(0);
            $table->unsignedBigInteger('user_id')->default(0);
            $table->string('url')->nullable();
            $table->string('notification_id')->nullable();
            $table->unsignedBigInteger('superadmin_notification')->default(0);
            $table->unsignedBigInteger('superadmin_read')->default(0);
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
        Schema::dropIfExists('notifications');
    }
};
