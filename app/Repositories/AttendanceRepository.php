<?php
namespace App\Repositories;

use App\Models\Attendance;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\Models\Lesson;
use App\Models\Schedule;

class AttendanceRepository {
    /**
     * @var Attendance
     */

    protected Attendance $attendance;

    public function __construct(Attendance $attendance)
    {
        $this->attendance = $attendance;
    }

    public function checkSchedule($userId, $dateCurrent, $session)
    {
        $scheduleId = Schedule::where([
                        ['user_id', $userId],
                        ['session', $session]
                    ])
                    ->whereRaw('DATEDIFF(?, date_start)%7 = 0
                                OR ? IN (SELECT l.date_change
                                        FROM leaves l
                                        WHERE l.schedule_id = schedules.id
                                        )',
                                [$dateCurrent, $dateCurrent])
                    ->whereRaw('NOT EXISTS (SELECT *
                                            FROM leaves l1
                                            WHERE l1.schedule_id = id
                                            AND l1.date_want = ?
                                            )', 
                                [$dateCurrent])
                    ->get();

        foreach ($scheduleId as $key => $value) {
            return $value->id;
        }
    }

    public function getInfoLesson($userId, $scheduleId, $dateCurrent)
    {
        $info = DB::select(
                        "SELECT u.name 'teacher_name', c.name 'class_name', 
                        sj.name 'subject_name', r.name 'room_name',
                            ( SELECT COUNT(*) FROM lessons l1
                             WHERE l1.schedule_id = ?
                             AND l1.date_learn IS NOT NULL
                            ) 'number_lesson', 
                        l.content, l.radius,
                            ( SELECT COUNT(*) FROM attendances
                             WHERE attendances.lesson_id = l.id
                            ) 'total_students'
                        FROM schedules s 
                        JOIN lessons l ON s.id = l.schedule_id
                        JOIN users u ON s.user_id = u.id
                        JOIN classes c ON s.class_id = c.id
                        JOIN subjects sj ON s.subject_id = sj.id
                        JOIN rooms r ON s.room_id = r.id
                        LEFT JOIN attendances a ON a.lesson_id = l.id
                        WHERE u.id = ?
                        AND s.id = ?
                        AND l.date_learn = ?
                        LIMIT 1",
                        [$scheduleId, $userId, 
                        $scheduleId, $dateCurrent]);
        return $info;
    }

    public function getIdLesson($scheduleId, $dateLearn)
    {
        $lessonId = Lesson::select('id')
                            ->where([
                                ['schedule_id', $scheduleId],
                                ['date_learn', $dateLearn]
                            ])
                            ->get();

        foreach ($lessonId as $key => $value) {
            return $value->id;
        }
    }

    public function checkStateAttendance($lessonId)
    {
        $state = Lesson::select('state')
                        ->where('id', $lessonId)
                        ->get();

        foreach ($state as $key => $value) {
            return $value->state;
        }
    }
    
    public function turnOnAttendance($lessonId, $radius, $latitude, $longitude)
    {
        return Lesson::where('id', $lessonId)
                        ->update(
                            [
                                'radius'   => $radius,
                                'latitude' => $latitude,
                                'longitude' => $longitude,
                                'state'    => 1
                            ]
                        );
    }

    public function turnOfAttendance($lessonId)
    {
        return Lesson::where('id', $lessonId)
                        ->update(['state'=> 0]);
    }

    public function insertListStudent($lessonId)
    {
        return DB::select("INSERT INTO attendances (lesson_id, user_id)
                            SELECT l.id,  u. id
                            FROM lessons l 
                            JOIN schedules s ON l.schedule_id = s.id 
                            JOIN classes c ON s.class_id = c.id 
                            JOIN users u ON u.userable_id = c.id 
                            JOIN roles r ON u.role_id = r.id 
                            WHERE l.id = ? AND r.name = 'student'",
                            [$lessonId]);
    }


    
}