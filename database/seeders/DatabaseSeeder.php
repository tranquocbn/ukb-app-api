<?php

namespace Database\Seeders;

use App\Models\Comment;
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
        $this->call(ServiceSeeder::class);
        $this->call(AcademicSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(AcademicDepartmentSeeder::class);
        $this->call(RoomSeeder::class);
        $this->call(SubjectSeeder::class);
        $this->call(ClassSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ScheduleSeeder::class);
        $this->call(LeaveSeeder::class);
        $this->call(LessonSeeder::class);
        $this->call(AttendanceSeeder::class);
        $this->call(ScoreSeeder::class);
        $this->call(ScoreFeedbackSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(CommentReplySeeder::class);
        $this->call(DocumentSeeder::class);
        $this->call(NotifySeeder::class);
    }
}
