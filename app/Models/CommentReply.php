<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    use HasFactory;

    protected $table = 'comment_replies';
    protected $fillable = [
        'comment_id',
        'user_id',
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
    public function comment()
    {
        return $this->belongsTo(Comment::class, 'comment_id','id');
    }
}
