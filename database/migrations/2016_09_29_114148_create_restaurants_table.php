<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('orig_id');
            $table->string('name', 50);
//            $table->string('floorplan_url', 150)->nullable();
            $table->string('image_url', 150)->nullable();
            $table->string('en_title', 50)->nullable();//英文
            $table->string('sc_title', 50)->nullable();//普通话
            $table->string('tc_title', 50)->nullable();//繁体
            $table->string('en_description', 1000)->nullable();//英文
            $table->string('sc_description', 1000)->nullable();//普通话
            $table->string('tc_description', 1000)->nullable();//繁体
            $table->string('logo_url', 500)->nullable();
            $table->string('tag', 50)->nullable();//标签
            $table->string('open_hours',50);
            $table->string('booking_hours',80);
            $table->string('contact_name', 50);
            $table->string('contact_phone', 20);
            $table->string('location', 100);
            $table->unsignedTinyInteger('booking_type');//0--chope ;1--priority;2--all
            $table->string('restaurant_url',150);
            $table->unsignedTinyInteger('active');//0--no;1--yes
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
        Schema::drop('restaurants');
    }
}
