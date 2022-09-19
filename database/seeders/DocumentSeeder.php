<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('documents')->insert([
            [
                'id' => 1,
                'schedule_id' => 1,
                'user_id' => 3,
                'url' => 'https://drive.google.com/drive/folders/1WfMz8LDmdm78TAQOjb260dgP3b5744KX'
            ],
            [
                'id' => 2,
                'schedule_id' => 2,
                'user_id' => 3,
                'url' => 'https://drive.google.com/drive/folders/1WfMz8LDmdm78TAQOjb260dgP3b5744KX'
            ],
        ]);
    }
}
