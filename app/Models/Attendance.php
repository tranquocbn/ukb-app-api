<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendances';
    protected $fillable = [
        'lesson_id',
        'user_id',
        'state',
        'device'
    ];

    /**
     * @return belongsTo
     */
    public function lessons()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id', 'id');
    }

    /**
     * @return belongsTo
     */
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
