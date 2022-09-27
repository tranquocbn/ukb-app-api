<?php

namespace Database\Seeders;

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
        DB::table('notifies')->insert([
            [
                'user_id' => 3,
                'notifiable_id' => 1,
                'notifiable_type' => 1,
                'state' => 0
            ],
        ]);
    }
}
