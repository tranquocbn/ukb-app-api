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
    
    public function updateScore($data)
    {
        return $this->model
            ->where('user_id', $data['studentId'])
            ->where('schedule_id', $data['scheduleId'])
            ->update([
                'diligent' => $data['diligent'],
                'test_one' => $data['test_one'],
                'test_two' => $data['test_two'],
                'exam_first' => $data['exam_first'],
                'exam_second' => $data['exam_second']
            ]);
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
}
