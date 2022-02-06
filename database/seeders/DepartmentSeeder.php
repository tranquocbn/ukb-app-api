<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            'id' => 1,
            'code' => 'CNTT',
            'name' => 'Công nghệ thông tin'
        ],
        [
            'id' => 2,
            'code' => 'KT',
            'name' => 'Kinh tế'
        ],
        [
            'id' => 3,
            'code' => 'DL',
            'name' => 'Du lịch'
        ]);
    }
}
