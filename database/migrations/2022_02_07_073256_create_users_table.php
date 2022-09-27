<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('class_id')->unsigned();
            $table->string('code')->unique();
            $table->string('name');
            $table->boolean('gender')->default(0)->comment('0: female, 1: male');
            $table->string('phone');
            $table->text('address');
            $table->string('email')->unique();
            $table->date('birthday');
            $table->text('avatar')->nullable();
            $table->string('password');
            $table->string('current_password');
            $table->integer('service_id')->unsigned();
            $table->integer('role')->comment('1: teacher | 2: student | 3: homeroom_teacher');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('class_id')->references('id')->on('classes');
            $table->foreign('service_id')->references('id')->on('services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
