<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $table = 'lessons';
    protected $fillable = [
        'schedule_id',
        'date_learn',
        'content',
        'radius',
        'latitude',
        'longitude',
        'evaluate',
        'comment',
        'state'
    ];

    /**
     * @return belongsTo
     */
    public function schedules()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id', 'id');
    }

    /**
     * @return hasOne
     */
    public function attendances()
    {
        return $this->hasOne(Attendance::class, 'lesson_id', 'id');
    }

    
}
