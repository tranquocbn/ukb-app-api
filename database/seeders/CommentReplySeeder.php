<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentReplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comment_replies')->insert([
            [
                'id' => 1,
                'comment_id' => 1,
                'user_id' => 3,
                'content' => 'Bài tập nộp trên link driver'
            ]
        ]);
    }
}
