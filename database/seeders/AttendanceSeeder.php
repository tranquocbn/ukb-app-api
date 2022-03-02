<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attendances')->insert([
            [
                'id' => 1,
                'lesson_id' => 1,
                'user_id' => 1,
                'state' => 0,
                'device' =>'357631050052050'
            ],
            [
                'id' => 2,
                'lesson_id' => 1,
                'user_id' => 2,
                'state' => 0,
                'device' =>'357631050052052'
            ],
            [
                'id' => 3,
                'lesson_id' => 2,
                'user_id' => 2,
                'state' => 0,
                'device' =>'357631050052052'
            ]
        ]);

    }
}
