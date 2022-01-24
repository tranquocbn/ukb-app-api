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
            $table->id();
            $table->integer('relationship_id');
            $table->string('code');
            $table->string('name');
            $table->tinyInteger('gender')->default(0);
            $table->string('phone_number')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('birthday')->nullable();
            $table->text('avatar')->nullable();
            $table->text('password');
            $table->text('password_current');
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
        Schema::dropIfExists('users');
    }
}
