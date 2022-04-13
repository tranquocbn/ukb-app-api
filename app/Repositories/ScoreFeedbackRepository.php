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

    /**
     * studentScoreFeedback function
     *
     * @param [type] $scoreId
     * @param [type] $reason
     * @return mixed
     */
    public function studentScoreFeedback($scoreId, $reason)
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

    /**
     * teacherScoreFeedback function
     *
     * @param [type] $scoreId
     * @param [type] $reasonFeedback
     * @return mixed
     */
    public function teacherScoreFeedback($scoreFeedbackId, $reasonFeedback)
    {
        return $this->model
            ->updateOrCreate(
                [
                    'id' => $scoreFeedbackId
                ], 
                [
                    'id' => $scoreFeedbackId,
                    'reason_feedback' => $reasonFeedback
                ]
            );
    }

    /**
     * getStudentByScoreFeedbackId function
     *
     * @param [type] $scoreFeedbackId
     * @return mixed
     */
    public function getStudentByScoreFeedbackId($scoreFeedbackId)
    {
        return $this->model
            ->where('id', $scoreFeedbackId)
            ->with('score')
            ->get();
    }
}
