<?php
namespace App\Repositories;

use App\Models\Attendance;
class AttendanceRepository extends BaseRepository
{
    /**
     * @var Attendance
     */

    protected Attendance $attendance;

    public function model()
    {
        return Attendance::class;
    }

    public function insertListStudent($lessonId)
    {
        // return DB::select("INSERT INTO attendances (lesson_id, user_id)
        //                     SELECT l.id,  u. id
        //                     FROM lessons l 
        //                     JOIN schedules s ON l.schedule_id = s.id 
        //                     JOIN classes c ON s.class_id = c.id 
        //                     JOIN users u ON u.userable_id = c.id 
        //                     JOIN roles r ON u.role_id = r.id 
        //                     WHERE l.id = ? AND r.name = 'student'",
        //                     [$lessonId]);
    }
  
}