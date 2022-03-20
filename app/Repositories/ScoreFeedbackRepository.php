<?php

namespace App\Repositories;

use App\Models\ScoreFeedback;
use Illuminate\Http\Request;

class ScoreFeedbackRepository extends BaseRepository
{
    public function model()
    {
        return ScoreFeedback::class;
    }

    public function createFeedback($scoreId, $reason)
    {
        return $this->model
            ->updateOrCreate(
                [
                    'score_id' => $scoreId
                ], 
                [
                    'score_id' => $scoreId,
                    'reason' => $reason
                ]
            );
    }
}
