<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'code' => '06d4800036',
                'name' => 'Tran Quoc',
                'email' => 'tranquocbn@gmail.com',
                'phone' => '0988088943',
                'address' => 'Bac Ninh',
                'birthday' => '1997-09-22',
                'password' => Hash::make('password'),
                'current_password' => 'password',
                'service_id' => 1,
                'userable_id' => 1,
                'userable_type' => 'classes',
                'role_id' => 2
            ],
            [
                'code' => '06d4800035',
                'name' => 'Le Thi Thue',
                'email' => 'thueth@gmail.com',
                'phone' => '095555555',
                'address' => 'Thanh Hoa',
                'birthday' => '1998-11-10',
                'password' => Hash::make('password'),
                'current_password' => 'password',
                'service_id' => 1,
                'userable_id' => 1,
                'userable_type' => 'classes',
                'role_id' => 2
            ],
            [
                'code' => 'gv01',
                'name' => 'Nguyen Thi Muoi Phuong',
                'email' => 'nguyenmuoiphuong@gmail.com',
                'phone' => '0988888888',
                'address' => 'Ha Noi',
                'birthday' => '1983-09-22',
                'password' => Hash::make('password'),
                'current_password' => 'password',
                'service_id' => 1,
                'userable_id' => 1,
                'userable_type' => 'classes',
                'role_id' => 1
            ]
        ]);
    }
}
