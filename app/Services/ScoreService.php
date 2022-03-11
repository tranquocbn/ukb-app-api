<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\ScoreRepository;
use App\Repositories\SubjectRepository;

class ScoreService extends BaseService
{
    protected ScoreRepository $scoreRepository;
    protected SubjectRepository $subjectRepository;

    /**
     * @param ScoreRepository $scoreRepository
     * @param SubjectRepository $subjectRepository
     */
    public function __construct(
        ScoreRepository $scoreRepository,
        SubjectRepository $subjectRepository
    )
    {
        $this->scoreRepository = $scoreRepository;
        $this->subjectRepository = $subjectRepository;
    }

    public function getScores(Request $request, $scheduleId)
    {
        $scores = $this->scoreRepository->getScores($request, $scheduleId)->toArray();
        return $this->resSuccessOrFail($scores, 'list score');
    }

}
