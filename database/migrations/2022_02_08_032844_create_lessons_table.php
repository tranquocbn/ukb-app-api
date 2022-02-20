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
            $table->date('date_learn');
            $table->text('content');
            $table->tinyInteger('radius')->unsigned()->min(5);
            $table->text('latitude');
            $table->text('longitude');
            $table->tinyInteger('evaluate')->comment('0: tốt, 1: khá, 2: trung bình, 3: kém');
            $table->text('comment');
            $table->boolean('state')->comment('trạng thái điểm danh');
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
