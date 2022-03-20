<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /**
         * $table->increments('id');
            $table->integer('schedule_id')->unsigned();
            $table->date('date_learn')->nullable();
            $table->text('content')->nullable();
            $table->tinyInteger('radius')->nullable()->unsigned()->min(5);
            $table->text('latitude')->nullable();
            $table->text('longitude')->nullable();
            $table->tinyInteger('evaluate')->nullable()->comment('0: excellent, 1: good, 2: average, 3: poor');
            $table->text('comment')->nullable();
            $table->boolean('state')->comment('1: not on | 2: on | 3: off');
            $table->timestamps();

            $table->foreign('schedule_id')->references('id')->on('schedules');
         */
        DB::table('lessons')
        ->insert([
            [
                'schedule_id' => 1,
                'date_learn'  => '2019-06-29',
                'content'     => 'Khái niệm tư tương hcm',
                'radius'      => 30,
                'latitude'    => '1232.2424.234',
                'longitude'   => '3252.324.334',
                'evaluate'    => 0,
                'comment'     => 'Sôi nổi',
                'state'       => 3
            ],
            [
                'schedule_id' => 1,
                'date_learn'  => '2019-07-06',
                'content'     => 'chương 1',
                'radius'      => 30,
                'latitude'    => '1232.2424.234',
                'longitude'   => '3252.324.334',
                'evaluate'    => 0,
                'comment'     => 'Sôi nổi',
                'state'       => 3
            ],
            [
                'schedule_id' => 1,
                'date_learn'  => '2019-07-14',
                'content'     => 'chương 2',
                'radius'      => 30,
                'latitude'    => '1232.2424.234',
                'longitude'   => '3252.324.334',
                'evaluate'    => 0,
                'comment'     => 'Sôi nổi',
                'state'       => 3
            ]

        ]);
    }
}
