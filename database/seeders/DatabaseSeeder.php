<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ServiceSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AcademicSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(AcademicDepartmentSeeder::class);
        $this->call(ClassSeeder::class);
        $this->call(SubjectSeeder::class);
        $this->call(RoomSeeder::class);
        // $this->call(ScheduleSeeder::class);
    }
}
