<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'schedule_id' => 1,
                'content' => 'Bài tập nộp đâu vậy cô'
            ]
        ]);
    }
}
