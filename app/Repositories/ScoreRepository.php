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
    
    public function updateScore($data, $array)
    {
        // return $this->model
        //     ->where('user_id', $data['studentId'])
        //     ->where('schedule_id', $data['scheduleId'])
        //     ->update([
        //         'diligent' => $data['diligent'],
        //         'test_one' => $data['test_one'],
        //         'test_two' => $data['test_two'],
        //         'exam_first' => $data['exam_first'],
        //         'exam_second' => $data['exam_second']
        //     ]);
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

    public function isEnableFeedback($userId, $subjectId, $date)
    {
        return $this->model
                ->where('user_id', $userId)
                ->whereHas('schedule', function($e) use($subjectId) {
                    $e->where('subject_id', $subjectId);
                })
                ->when('updated_at', function($e) use ($date) {
                    $e->whereRaw("DATEDIFF(?, updated_at) <= 3", $date);
                }, function($e) use ($date) {
                    $e->whereRaw("DATEDIFF(?, create_at) <= 3", $date);
                })
                ->get();
    }
}
