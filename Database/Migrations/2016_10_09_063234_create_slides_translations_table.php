<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSlidesTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slider__slide_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('slide_id')->unsigned();
            $table->string('locale')->index();

            $table->string('title');
            $table->string('caption')->nullable();
            $table->string('url')->nullable();
            $table->string('uri')->nullable();
            $table->boolean('active')->default(false);

            $table->unique(['slide_id', 'locale']);
            $table->foreign('slide_id')->references('id')->on('slider__slides')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('slider__slide_translations');
    }
}
