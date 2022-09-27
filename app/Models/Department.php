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

}
