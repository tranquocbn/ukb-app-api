<?php
namespace App\Repositories;

use App\Models\Attendance;
use DB;

class AttendanceRepository {
    /**
     * @var Attendance
     */

    protected Attendances $attendances;

    public function __construct(Attendances $attendances)
    {
        $this->attendances = $attendances;
    }
    
    public function checkSchedule($user_code, $class_code)
    {
        $date = date('Y/m/d');
        return DB::select("SELECT * FROM `schedules` s 
                            JOIN users u ON s.user_id = u.id
                            JOIN classes c ON s.class_id = c.id
                            JOIN subjects sj ON s.subject_id = sj.id
                            WHERE u.code = ?
                                AND c.code = ? 
                                AND (
                                    s.date_change = null
                                    AND s.date_start_learn = ? 
                                    )
                                OR s.date_change = ?", 
                            [$user_code, $class_code, $date, $date]);
    }

    public function getInfoLesson($user_code, $class_code)
    {
        $date = date('Y/m/d');
        return DB::select("SELECT u.name 'user_name', c.name 'classes_name', 
                            sj.name 'subjects_name', l.radius
                            FROM attendances atd
                            JOIN lessons l ON atd.lesson_id = l.id
                            JOIN schedules s ON l.schedule_id = s.id
                            JOIN users u ON s.user_id = u.id
                            JOIN classes c ON s.class_id = c.id
                            JOIN subjects sj ON s.subject_id = s.id
                            WHERE u.code = ?
                            AND c.code = ?
                            AND (s.date_change = null
                                AND s.date_start_learn = ? 
                                )
                            OR s.date_change = ?", 
                            [$user_code, $class_code, $date, $date]);
    }
}