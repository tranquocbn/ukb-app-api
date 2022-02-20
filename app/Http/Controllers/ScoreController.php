<?php

namespace App\Http\Controllers;

use App\Services\ScoreService;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    private ScoreService $scoreService;

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
}
