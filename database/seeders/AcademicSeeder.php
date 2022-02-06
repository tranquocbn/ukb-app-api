<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AcademicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('academics')->insert([
            'id' => 1,
            'code' => 'K6',
            'name' => 'Khóa 6',
            'price_credit' => 420
        ],
        [
            'id' => 2,
            'code' => 'K8',
            'name' => 'Khóa 8',
            'price_credit' => 440
        ]);
    }
}
