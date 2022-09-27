<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $table = 'documents';
    protected $fillable = [
        'schedule_id',
        'user_id',
        'url'
    ];

    /**
     * @return belongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }

    /**
     * @return belongsTo
     */
    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id','id');
    }
}
