<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            'start_date' => now(),
            'end_date' => now()
        ]);
        // \App\Models\User::factory(10)->create();
        DB::table('users')->insert([
            'code' => 'K6',
            'name' => 'Tran Quoc',
            'email' => 'tranquocbn@gmail.com',
            'phone' => '0988088943',
            'address' => 'Bac Ninh',
            'birthday' => '1997-09-22',
            'password' => Hash::make('password'),
            'current_password' => 'password',
            'service_id' => 1,
            'relation_id' => 1,
            'relation_type' => 'classes'
        ]);
    }
}
