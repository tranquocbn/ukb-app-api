<?php

namespace App\Repositories;

use App\Models\Score;
use Illuminate\Http\Request;

class ScoreRepository extends BaseRepository
{
    public function model()
    {
        return Score::class;
    }

    /**
     * get scores
     * @param Request $request
     * @param $scheduleId
     * @return mixed
     */
    public function getScores(Request $request, $scheduleId)
    {
        $user = $request->user();
        return $this->model
        ->where('user_id', $user->id)
        ->where('schedule_id', $scheduleId)
        ->with('schedule')
        ->with('scoreFeedbacks')
        ->get();
    }

    /**
     * teacherGetScores
     *
     * @param [type] $scheduleId
     * @param [type] $classId
     * @return mixed
     */
    public function teacherGetScores($scheduleId, $classId)
    {
        return $this->model
            ->where('schedule_id', $scheduleId)
            ->whereHas('user', function($e) use ($classId) {
                $e->where('userable_id', $classId);
            })
            ->get();
    }

    /**
     * getScoreByStudentId function
     *
     * @param [type] $scheduleId
     * @param [type] $studentId
     * @return mixed
     */
    public function getScoreByStudentId($scheduleId, $studentId)
    {
        return $this->model
            ->where('user_id', $studentId)
            ->where('schedule_id', $scheduleId)
            ->get();
    }

    /**
     * updateScore function
     * @param array $data
     * @return mixed
     */
    
    public function updateScore($data, $array)
    {
        return $this->model
            ->updateOrCreate($data, $array);
    }

    /**
     * studentGetScore function
     *
     * @param [type] $userId
     * @param [type] $scheduleId
     * @return mixed
     */
    public function studentGetScore($userId, $scheduleId)
    {
        return $this->model
            ->where('user_id', $userId)
            ->where('id', $scheduleId)
            ->get();
    }

    /**
     * isEnableFeedback function
     * @param [type] $scoreId
     * @param [type] $date
     * @return 
     */
    public function isEnableFeedback($scoreId, $date)
    {
        return $this->model
            ->where('id', $scoreId)
            ->when('updated_at', function($e) use ($date) {
                $e->whereRaw("DATEDIFF(?, updated_at) <= 3", $date);
            }, function($e) use ($date) {
                $e->whereRaw("DATEDIFF(?, create_at) <= 3", $date);
            })
            ->get();
    }

    /**
     * getScheduleByScoreId function
     *
     * @param [type] $scoreId
     * @return mixed
     */
    public function getScheduleByScoreId($scoreId)
    {
        return $this->model
            ->where('id', $scoreId)
            ->with('schedule')
            ->get();
    }
}
