<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type',20);//发送类型
            $table->string('title',50);
            $table->string('message',150);
            $table->string('send_time',20);
            $table->string('send_rate',10);
            $table->string('advanced_options',20);
            $table->string('message_id',100);
            $table->unsignedTinyInteger('backend_id')->default(0);//0--自动发送
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('notifications');
    }
}
