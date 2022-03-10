<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('schedules')->insert([
            [
                'id' => 1,
                'user_id' => 3,
                'class_id' => 1,
                'subject_id' => 1,
                'room_id' => 1,
                'date_start' => '2019-06-22',
                'session' => true,
                'semester' => 6
            ],
            [
                'id' => 2,
                'user_id' => 3,
                'class_id' => 1,
                'subject_id' => 2,
                'room_id' => 1,
                'date_start' => '2018-06-22',
                'session' => true,
                'semester' => 4
            ],
            [
                'id' => 3,
                'user_id' => 3,
                'class_id' => 2,
                'subject_id' => 1,
                'room_id' => 1,
                'date_start' => '2021-06-22',
                'session' => true,
                'semester' => 6
            ]
        ]);
    }
}
