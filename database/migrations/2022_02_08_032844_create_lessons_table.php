<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('schedule_id')->unsigned();
            $table->date('date_learn')->nullable();
            $table->text('content')->nullable();
            $table->tinyInteger('radius')->nullable()->unsigned()->min(5);
            $table->text('latitude')->nullable();
            $table->text('longitude')->nullable();
            $table->tinyInteger('evaluate')->nullable()->comment('0: excellent, 1: good, 2: average, 3: poor');
            $table->text('comment')->nullable();
            $table->tinyInteger('state')->comment('1: not on | 2: on | 3: off');
            $table->timestamps();

            $table->foreign('schedule_id')->references('id')->on('schedules');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lessons');
    }
}
