<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotifySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('notifies') ->insert([
            [
                'user_id' => '',
                'notifiable_id' => '',
                'notifiable_type' => '',
                'state' => ''
            ],
            [
                
            ]
        ]);
    }
}
