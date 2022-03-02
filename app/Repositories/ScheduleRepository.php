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



    /**
     * input: userId, date, session
     * output: có lịch trình ?
     * có lịch trình: ngày != date_want và ngày-date_start%7=0 hoặc ngày = date_change
     * ko có lịch trình: ngày = date_want hoặc (ngày-date_start%7 != 0 và ngày != date_change)
     */
    public function checkSchedule($userId, $date, $session)
    {
        return $this->model
            ->where('user_id', $userId)
            ->where('session', $session)
            ->when(true, function($query) use ($date) {
                $this->model->leaves()->where('date_want', '=', $date);
            })
            
            ->get();
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
