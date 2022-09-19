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
        'session',
        'semester'
    ];

    /**
     * @return hasMany
     */
    public function leaves()
    {
        return $this->hasMany(Leave::class, 'schedule_id', 'id');
    }

    /**
     * @return belongsTo
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    /**
     * @return hasMany
     */
    public function scores()
    {
        return $this->hasMany(Score::class);
    }

    /**
     * @return belongsTo
     */
    public function class()
    {
        return $this->belongsTo(Classroom::class, 'class_id', 'id');
    }

    /**
     * @return belongsTo
     */
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }

    /**
     * @return belongsTo
    */
    public function teacher()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return hasMany
     */
    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'schedule_id', 'id');
    }

    /**
     *
     * @return hasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'schedule_id', 'id');
    }

    /**
     *
     * @return hasMany
     */
    public function document()
    {
        return $this->hasOne(Comment::class, 'schedule_id', 'id');
    }
}
