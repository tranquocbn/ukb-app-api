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
            ->select('subjects.name', 'schedules.id', 'schedules.date_start')
            ->where('class_id', $classId)
            ->where('semester', $semester)
            ->join('subjects', 'subjects.id', '=', 'schedules.subject_id')
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
            ->where(function($query) use ($date){
                $query->whereRaw('DATEDIFF(?, date_start)%7 = 0',[$date])
                ->orWhereExists(function() use ($date){
                        $this->model->with('leaves')
                            ->where('leaves.date_change', $date);
                        });
            })
            ->whereDoesntHave('leaves', function() use ($date){
                $this->model
                    ->with(['leaves'=>function($query)use ($date){
                            $query->where('leaves.date_want', $date);
                }]);
            })
            ->toSql();
    }

    public function getInfoLesson($userId, $scheduleId, $dateCurrent)
    {
        return $this->model
                ->where('id', $scheduleId)
                ->where('user_id', $userId)
                ->with([
                    'teacher:id,name',
                    'class:id,name', 
                    'subject:id,name', 
                    'room:id,name',])
                ->with(['lessons'=>function($query) use ($dateCurrent){
                        $query->where('date_learn', $dateCurrent)
                        ->get();
                    }])
                ->get();
    }
}
