<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notify extends Model
{
    use HasFactory;
    
    protected $table = 'notifies';
    protected $fillable = [
        'user_id',
        'notifiable_id',
        'notifiable_type',
        'state'
    ];

    /**
     *
     * @return belongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     *
     * @return morphTo
     */
    public function notifiable()
    {
        return $this->morphTo(null, 'notifiable_type', 'notifiable_id');
    }
}
