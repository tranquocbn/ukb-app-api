<?php
namespace App\Repositories;

use App\Models\Attendance;
use Illuminate\Support\Facades\DB;

class AttendanceRepository {
    /**
     * @var Attendance
     */

    protected Attendance $attendance;

    public function __construct(Attendance $attendance)
    {
        $this->attendance = $attendance;
    }

    public function checkSchedule($user_code, $date, $session)
    {
        $schedule_id = DB::select("SELECT s.id 
                                    FROM schedules s 
                                    JOIN leaves l ON s.id = l.schedule_id
                                    JOIN users u ON s.user_id = u.id
                                    WHERE u.code = ?
                                    AND l.date_change = ?
                                    AND s.session = ?",
                                    [$user_code, $date, $session]);

        if(!$schedule_id) {
            $schedule_id = DB::select("SELECT s.id 
                                        FROM schedules s 
                                        JOIN users u ON s.user_id = u.id
                                        WHERE u.code = ?
                                        -- AND (DATEDIFF($date,s.date_start) % 7) = 0
                                        AND s.date_start = ?
                                        AND s.session = ?",
                                        [$user_code, $date, $session]);
        }   
        return $schedule_id;                    
    }

    public function getInfoLesson($user_code, $schedule_id)
    {
        return DB::select("SELECT u.name 'teacher_name', c.name 'class_name', 
                            sj.name 'subject_name', r.name 'room_name'
                            FROM schedules s
                            JOIN users u ON s.user_id = u.id
                            JOIN classes c ON s.class_id = c.id
                            JOIN subjects sj ON s.subject_id = sj.id
                            JOIN rooms r ON s.room_id = r.id
                            WHERE u.code = ? 
                            AND s.id = ?",
                            [$user_code,$schedule_id]);
    }
}