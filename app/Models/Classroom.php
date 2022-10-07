<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $table = 'classes';
    protected $fillable = [
        'code',
        'name',
        'academic_department_id'
    ];

    /**
     * @return belongsTo
     */

    public function academicDepartment()
    {
        return $this->belongsTo(AcademicDepartment::class, 'academic_department_id', 'id');
    }

    /**
     * @return belongsToMany
    */
    public function teachers()
    {
        return $this->belongsToMany(User::class, 'schedules', 'class_id', 'user_id');
    }

    /**
     * @return hasMany
    */
    public function students()
    {
        return $this->hasMany(User::class, 'class_id', 'id');
    }

    /**
     * @return belongsToMany
    */
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'schedules', 'class_id', 'subject_id');
    }

    /**
     * @return belongsToMany
    */
    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'schedules', 'class_id', 'room_id');
    }

    /**
     * @return hasMany
    */
    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'class_id', 'id');
    }
}
