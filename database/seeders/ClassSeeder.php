<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classes')->insert([
            [
                'id' => 1,
                'code' => '06DCNTT1',
                'name' => '06D công nghệ thông tin 1',
                'academic_department_id' => 1
            ],
            [
                'id' => 2,
                'code' => '06DCNTT2',
                'name' => '06D công nghệ thông tin 2',
                'academic_department_id' => 1
            ],
            [
                'id' => 3,
                'code' => '08DDL1',
                'name' => '08D du lịch 1',
                'academic_department_id' => 2
            ]
        ]);
    }
}
