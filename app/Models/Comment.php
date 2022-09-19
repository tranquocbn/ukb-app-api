<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';
    protected $fillable = [
        'user_id',
        'schedule_id',
        'content'
    ];

    /**
     * @return belongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }

    /**
     *
     * @return belongsTo
     */
    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id','id');
    }

    /**
     *
     * @return hasMany
     */
    public function commentReplys()
    {
        return $this->hasMany(CommentReply::class, 'comment_id', 'id');
    }
}
