<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeaveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
        DB::table('leaves')->insert([
            [
                'id' => 1,
                'schedule_id'  => 1,
                'user_id' => 1,
                'date_application' => '2019-07-12',
                'date_want' => '2019-07-13',
                'date_change' => null,
                'reason' => 'Nghi om',
                'reason_refusal' => null
            ],
            [
                'id' => 3,
                'schedule_id'  => 1,
                'user_id' => 1,
                'date_application' => '2019-07-12',
                'date_want' => '2019-07-13',
                'date_change' => '2019-07-14',
                'reason' => 'Nghi om',
                'reason_refusal' => null
            ],
            [
                'id' => 2,
                'schedule_id'  => 1,
                'user_id' => 3,
                'date_application' => '2019-07-12',
                'date_want' => '2019-07-13',
                'date_change' => null,
                'reason' => 'Nghi om',
                'reason_refusal' => null
            ],
            
        ]);
    }
}
