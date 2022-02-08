<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->insert([
            [
                'code' => 'TBCHP',
                'name' => 'Tư tưởng Hồ Chí Minh',
                'credit' => 2
            ], 
            [
                'code' => 'ISO18',
                'name' => 'Hệ quản trị cơ sở dữ liệu',
                'credit' => 3
            ],
            [
                'code' => 'LSDCSVN',
                'name' => 'Lịch sử Đảng Cộng Sản Việt Nam',
                'credit' => 2
            ],
            [
                'code' => 'ISO02',
                'name' => 'Cơ sở dữ liệu',
                'credit' => 3
            ]
        ]);
    }
}
