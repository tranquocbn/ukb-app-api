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

    public function getDateWant($userId, $date)
    {
        return $this->model
            ->with('leaves')
            ->where('user_id', $userId)
            ->where('date_want', $date)
            ->get();
    }

    /**
     * check Schedule of user
     * @param $userId, $dateCurrent, $session
     * @return mixed
     */

    public function checkSchedule($userId, $date, $session)
    {
        return $this->model
            ->where('user_id', $userId)
            ->where('session', $session)
            ->whereRaw("DATEDIFF(?, date_start)%7 = 0", $date)
            ->orWhereHas('leaves', function($query) use ($date){
                $query->where('date_change', $date);
            })
            ->get()
            ->pluck('id');
    }

    public function getInfoLesson($userId, $scheduleId, $date)
    {
        return $this->model
                ->where('id', $scheduleId)
                ->where('user_id', $userId)
                ->with([ 'teacher:id,name', 'class:id,name', 'subject:id,name', 'room:id,name'])
                ->with(['lessons'=>function($query) use ($date){
                        $query->where('date_learn', $date);
                    }])
                ->withCount(['lessons', 'lessons' => function ($query) use ($date) {
                    $query->whereNotNull('date_learn');
                }])
                ->get();
    }
}
