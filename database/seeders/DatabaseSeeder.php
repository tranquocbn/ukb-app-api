<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AcademicSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(AcademicDepartmentSeeder::class);
        $this->call(RoomSeeder::class);
        $this->call(SubjectSeeder::class);
        $this->call(ClassSeeder::class);
        $this->call(ScheduleSeeder::class);
        $this->call(LeaveSeeder::class);
        $this->call(LessonSeeder::class);
        $this->call(AttendanceSeeder::class);
        $this->call(ScoreSeeder::class);
        $this->call(ScoreFeedBackSeeder::class);
    }
}
