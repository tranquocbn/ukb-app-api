<?php

namespace App\Repositories;

use App\Models\Schedule;
class ScheduleRepository extends BaseRepository
{

    public function model()
    {
        return Schedule::class;
    }
    
    /**
     * get subjects in semester current
     * @return mixed
     */
    public function getSubjectsInSemesterCurrent($classId, $semester)
    {
        return $this->model
            ->select('subjects.name', 'schedules.id', 'schedules.date_start')
            ->where('class_id', $classId)
            ->where('semester', $semester)
            ->join('subjects', 'subjects.id', '=', 'schedules.subject_id')
            ->get();
    }

    /**
     * getDateWant of teacher
     * @param $userId, $date
     * @return mixed
     */
    public function getDateWant($userId, $date)
    {
        return $this->model
            ->with('leaves')
            ->where('user_id', $userId)
            ->where('date_want', $date)
            ->get();
    }
    
    /**
     * check Schedule of student
     * @param $classId, $date, $session
     * @return mixed
     */
    public function checkSchedule($field, $id, $date, $session)
    {
        return $this->model
            ->select('id')
            ->where($field, $id)
            ->where('session', $session)
            // ->whereYear('date_start', date_format($date, 'Y'))
            ->whereRaw("DATEDIFF(?, date_start)%7 = 0", $date)
            ->orWhereHas('leaves', function($query) use ($date){
                $query->where('date_change', $date);
            })
            ->get();
    }

    /**
     * isLeave of student
     * @param $classId, $date
     * @return mixed
     */
    public function isLeave($classId, $date)
    {
        return $this->model
            ->where('class_id', $classId)
            ->whereHas('leaves', function($query) use ($date){
                $query->where('date_want', $date);
            })
            ->get();
    }
    

    


    
}
