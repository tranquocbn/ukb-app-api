<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academic extends Model
{
    use HasFactory;

    protected $table = 'academics';
    protected $fillable = [
        'code',
        'name',
        'price_credit',
        'year_start'
    ];

    /**
     * @return belongsToMany
     */
    public function departments()
    {
        return $this->belongsToMany(Department::class, 'academic_departments', 'academic_id', 'department_id');
    }

    /**
     * hasManyThrough function
     *
     * @return void
     */
    public function classes()
    {
        return $this->hasManyThrough(
            Classroom::class, 
            AcademicDepartment::class, 
            'academic_id', 
            'academic_department_id', 
            'id', 
            'id'
        );
    }
}
