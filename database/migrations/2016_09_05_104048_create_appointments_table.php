<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedTinyInteger('backend_user_id');
            $table->string('backend_user_name',50);
            $table->unsignedTinyInteger('user_id');
            $table->string('location',50);
            $table->unsignedTinyInteger('room_id');
            $table->string('date',50);
            $table->unsignedTinyInteger('time_from');
            $table->unsignedTinyInteger('time_to');
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
        Schema::drop('appointments');
    }
}
