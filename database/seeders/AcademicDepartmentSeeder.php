<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AcademicDepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('academic_departments')->insert([
            [
                'id' => 1,
                'academic_id' => 1,
                'department_id' => 1
            ],
            [
                'id' => 2,
                'academic_id' => 2,
                'department_id' => 3
            ]
         ]);
    }
}
