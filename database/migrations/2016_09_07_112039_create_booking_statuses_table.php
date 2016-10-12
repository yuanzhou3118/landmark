<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('booking_code',50);
            $table->unsignedTinyInteger('backend_user_id');
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
        Schema::drop('booking_statuses');
    }
}
