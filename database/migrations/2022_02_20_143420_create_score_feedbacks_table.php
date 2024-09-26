<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoreFeedbacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('score_feedbacks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('score_id')->unsigned();
            $table->text('reason');
            $table->text('reason_feedback');
            $table->timestamps();

            $table->foreign('score_id')->references('id')->on('scores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('score_feedbacks');
    }
}
