<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('class_id');
            $table->integer('subject_id');
            $table->integer('room_id')->nullable();
            $table->date('date_start_learn')->nullable();
            $table->tinyInteger('day')->nullable();
            $table->date('date_change')->nullable();
            $table->tinyInteger('session')->nullable();
            $table->tinyInteger('semester')->nullable();
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
        Schema::dropIfExists('schedules');
    }
}
