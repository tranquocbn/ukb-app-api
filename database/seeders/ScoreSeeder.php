<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('scores')->insert([
            [
                'user_id' => 1,
                'schedule_id' => 1,
                'test_one' => 8,
                'test_two' => 9,
                'exam_first' => 8.8
            ],
            [
                'user_id' => 2,
                'schedule_id' => 1,
                'test_one' => 4,
                'test_two' => 7,
                'exam_first' => 2,
                'exam_second' => 7
            ],
            [
                'user_id' => 2,
                'schedule_id' => 2,
                'test_one' => 8,
                'test_two' => 7,
                'exam_first' => 9
            ],
            [
                'user_id' => 1,
                'schedule_id' => 2,
                'test_one' => 5,
                'test_two' => 7,
                'exam_first' => 4,
                'exam_second' => 8
            ]
        ]);
    }
}
