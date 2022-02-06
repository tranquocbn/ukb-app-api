<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $table = 'departments';
    protected $fillable = [
        'code',
        'name'
    ];

    /**
     * @return belongsToMany
     */
    public function academics()
    {
        return $this->belongsToMany(Academic::class, 'academic_department', 'academic_id', 'department_id');
    }

    /**
     * @return morphMany
     */
    public function users()
    {
        return $this->morphMany(User::class, 'userable', 'userable_type', 'userable_id');
    }
}
