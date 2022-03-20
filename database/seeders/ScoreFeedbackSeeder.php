<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScoreFeedBackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('score_feedbacks')
        ->insert([
            [
                'score_id' => 1,
                'reason' => 'Điểm quá thấp',
                'created_at' => '2022-01-11'
            ],
            [
                'score_id' => 2,
                'reason' => 'Đề sai câu 13',
                'created_at' => '2022-02-11'
            ],
            [
                'score_id' => 1,
                'reason' => 'Điểm thấp lắm',
                'created_at' => '2022-01-17'
            ],
        ]);
    }
}
