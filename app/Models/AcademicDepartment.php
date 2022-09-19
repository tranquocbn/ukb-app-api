<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicDepartment extends Model
{
    use HasFactory;

    protected $table = 'academic_department';
    protected $fillable = [
        'academic_id',
        'department_id'
    ];

    /**
     * @return hasMany
     */
    public function classes()
    {
        return $this->hasMany(Classroom::class, 'academic_department_id', 'id');
    }
}
