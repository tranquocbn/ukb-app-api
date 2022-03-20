<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $table = 'scores';
    protected $fillable = [
        'user_id',
        'schedule_id',
        'diligent',
        'test_one',
        'test_two',
        'exam_first',
        'exam_second'
    ];

    /**
     * @return belongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return belongsTo
     */
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
    
    /**
     * @return hasMany
     */
    public function scoreFeedbacks()
    {
        return $this->hasMany(ScoreFeedback::class);
    }

    /**
     *
     * @return morphOne
     */
    public function notify()
    {
        return $this->morphOne(Notify::class, 'notifiable', 'notifiable_type', 'notifiable_id');
    }
}
