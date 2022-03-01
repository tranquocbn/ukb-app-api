<?php

namespace App\Repositories;

use App\Models\Schedule;
use App\Models\Leave;

use Illuminate\Support\Facades\DB;
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
            ->where('class_id', $classId)
            ->where('semester', $semester)
            ->with('subject')
            ->withCount('lessons')
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
            ->whereRaw('DATEDIFF(?, date_start) % 7 = 0', [$date])
            ->whereDoesntHave('leaves', function($query) use ($date){
                $query->where('date_want', $date);
            })
            ->orWhereHas('leaves', function ($query) use ($date){
                $query->where('date_change', '=', $date);
            })
            ->first();
    }

    public function getInfoLesson($userId, $scheduleId, $dateCurrent)
    {
        return $this->model
                ->where('id', $scheduleId)
                ->where('user_id', $userId)
                ->with([ 'teacher:id,name', 'class:id,name', 'subject:id,name', 'room:id,name'])
                ->with(['lessons'=>function($query) use ($dateCurrent){
                        $query->where('date_learn', $dateCurrent);
                    }])
                ->withCount(['lessons', 'lessons' => function ($query) {
                    $query->where('date_learn', '>=', '2019-06-22');
                }])
                ->get();
    }
}
