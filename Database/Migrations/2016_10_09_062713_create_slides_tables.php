<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSlidesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slider__slides', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('slider_id')->unsigned();
            $table->foreign('slider_id')->references('id')->on('slider__sliders')->onDelete('cascade');

            $table->integer('page_id')->unsigned()->nullable();
            $table->integer('position')->unsigned()->default(0);
            $table->string('target', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('slider__slides');
    }
}
