<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;
    
    protected $table = 'leaves';
    protected $fillable = [
        'schedule_id',
        'user_id',
        'date_application',
        'date_want',
        'date_change',
        'reason',
        'reason_refusal'
    ];
}
