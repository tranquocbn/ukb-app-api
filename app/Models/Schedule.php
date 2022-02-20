<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'schedules';
    protected $fillable = [
        'user_id',
        'class_id',
        'subject_id',
        'room_id',
        'date_start',
        'date_change',
        'seesion',
        'semester'
    ];

    /**
     * @return belongsTo
     */
    public function teachers()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return hasMany
     */
    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'lessons_id', 'id');
    }

    /**
     * @return belongsTo
     */
    public function classes()
    {
        return $this->belongsTo(Classroom::class, 'classes_id', 'id');
    }

    /**
     * @return belongsTo
     */
    public function subjects()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    /**
     * @return belongsTo
     */
    public function rooms()
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }

    /**
     * @return hasMany
     */
    public function leaves()
    {
        return $this->hasMany(Leave::class, 'schedule_id', 'id');
    }
}
