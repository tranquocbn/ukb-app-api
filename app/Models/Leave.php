<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Leave extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'leaves';
    protected $fillable = [
        'schedule_id',
        'user_id',
        'date_application',
        'date_want',
        'date_change',
        'reason',
        'reason_refusal',
        'status'
    ];

    /**
     * @return belongsTo
     */
    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id', 'id');
    }

    /**
     * @return belongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
