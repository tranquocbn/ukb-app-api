<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $timestamps = false;
    protected $table = 'services';
    protected $fillable = ['start_date', 'end_date'];
}
