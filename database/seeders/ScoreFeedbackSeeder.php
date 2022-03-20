<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScoreFeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('score_feedbacks') ->insert([
            [
                'score_id' => 1,
                'reason' => 'sao điểm em thấp vậy thầy?',
                'reason_feedback' => 'do em sai nhiều'
            ],
            [
                'score_id' => 3,
                'reason' => 'sao điểm em thấp vậy thầy? em sai phần nào ạ?',
                'reason_feedback' => 'sai câu cuối!'
            ]
        ]);
    }
}
