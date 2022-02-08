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

}
