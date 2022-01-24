<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    public function academic_department()
    {
        return $this->hasOne('App\Models\AcademicDeparment', 'department_id', 'id');
    }

    public function academic()
    {
        return $this->belongsToMany(Academic::class);
    }
}
