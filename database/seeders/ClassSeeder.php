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
            'id' => 1,
            'code' => '06DCNTT1',
            'name' => '06D công nghệ thông tin',
            'academic_department_id' => 1
        ]);
    }
}
