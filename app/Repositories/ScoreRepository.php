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
}
