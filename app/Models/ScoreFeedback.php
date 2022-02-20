<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScoreFeedback extends Model
{
    use HasFactory;

    protected $table = 'score_feedbacks';

    protected $fillable = [
        'score_id',
        'reason',
        'reason_feedback'
    ];

    /**
     * @return belongsTo
     */
    public function score()
    {
        return $this->belongsTo(Score::class);
    }
}
