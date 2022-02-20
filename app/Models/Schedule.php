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
     * 
     */
    public function leaves()
    {
        return $this->hasMany(Leave::class, 'schedule_id', 'id');
    }

    /**
     * 
     */
    public function subject()
    {
        return $this->hasOne(Subject::class, 'subject_id', 'id');
    }


}
