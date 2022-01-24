<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicDeparment extends Model
{
    use HasFactory;

    public function academic() {
        return $this->hasOne(Academic::class);
    }

}
