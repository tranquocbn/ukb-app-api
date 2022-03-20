<?php

namespace App\Http\Controllers\Teacher;

use App\Services\ScoreService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScoreController extends Controller
{
    protected ScoreService $scoreService;

    /**
     * @param ScoreService $scoreService
     */
    public function __construct(
        ScoreService $scoreService
    )
    {
        $this->scoreService = $scoreService;
    }

    /**
     * showScores function
     *
     * @param Request $request
     * @param $scheduleId
     * @return mixed
     */
    public function showScores(Request $request, $scheduleId)
    {
        return $this->scoreService->getScores($request, $scheduleId);
    }

    /**
     * getScores function
     *
     * @param Request $request
     * @return mixed
     */
    public function getScores (Request $request)
    {
        return $this->scoreService->teacherGetScores($request);
    }

    public function getScoreByStudentId(Request $request)
    {
        return $this->scoreService->getScoreByStudentId($request);
    }

    /**
     * updateScore function
     *
     * @param Request $request
     * @return mixed
     */
    public function updateScore(Request $request)
    {
        return $this->scoreService->updateScore($request);
    }  

    /**
     * feedbackScore function
     *
     * @param Request $request
     * @return mixed
     */
    public function feedbackScore(Request $request)
    {
        return $this->scoreService->teacherScoreFeedback($request);
    }
}
