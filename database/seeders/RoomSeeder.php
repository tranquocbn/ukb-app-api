<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rooms')->insert([
            [
                'id'    => 1,
                'code'  => 'A01',
                'name'  => 'Day nha A, phong so 1'
            ],
            [
                'id'    => 2,
                'code'  => 'A02',
                'name'  => 'Day nha A, phong so 2'
            ],
            [
                'id'    => 3,
                'code'  => 'B01',
                'name'  => 'Day nha B, phong so 1'
            ]
        ]);
    }
}
