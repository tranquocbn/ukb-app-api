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

    public function users()
    {
        return $this->morphMany(User::class, 'userable', 'userable_type', 'userable_id');
    }
}
