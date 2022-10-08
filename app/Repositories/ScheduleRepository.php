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
            ->where('class_id', $classId)
            ->where('semester', $semester)
            ->with('subject')
            ->withCount('lessons')
            ->get();
    }

    /**
     * getSemesters function
     *
     * @param array $data
     * @return mixed
     */
    public function getSemesters(array $data)
    {
        return $this->model
            ->where('class_id', $data['classId'])
            ->where('date_start', '<=', $data['date'])
            ->with('subject')
            ->get();
    }

    /**
     * get teacher by scheduleId function
     *
     * @param integer $id
     * @return mixed
     */
    public function getTeacherByScheduleId(int $scheduleId)
    {
        return $this->model
        ->select('user_id')
        ->where('id', $scheduleId)
        ->first();
    }

    public function yearLearn($userId)
    {
        return $this->model
        ->where('user_id', $userId)
        ->get();
    }
    
}
