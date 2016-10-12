<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('booking_code',50)->nullable();//12-16位的一个编号
            $table->unsignedInteger('mobile_user_id');
            $table->string('customer_firstname',20);
            $table->string('customer_lastname',20);
            $table->string('restaurant_name',50);
            $table->string('special_req',150);//用户的留言
            $table->unsignedInteger('restaurant_id');
            $table->unsignedTinyInteger('booking_type');
            $table->unsignedTinyInteger('adult');
            $table->unsignedTinyInteger('children');
            $table->string('time',20);//2010-10-15 12:00:00
            $table->unsignedTinyInteger('status');//进行状况，0--进行中，1--成功，2--失败
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
        Schema::drop('bookings');
    }
}
