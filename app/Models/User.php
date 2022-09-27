<?php

namespace App\Models;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'service_id',
        'class_id',
        'role',
        'code',
        'name',
        'gender',
        'phone',
        'address',
        'email',
        'birthday',
        'avatar',
        'password',
        'current_password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function class()
    {
        return $this->belongsTo(Classes::class);
    }

    /**
     * @return belongsToMany
    */
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'schedules', 'user_id', 'subject_id');
    }

    /**
     * @return belongsToMany
    */
    public function classes()
    {
        return $this->belongsToMany(User::class, 'schedules', 'user_id', 'class_id');
    }

    /**
     * @return belongsToMany
    */
    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'schedules', 'user_id', 'room_id');
    }

    /**
     * @return hasMany
     */
    public function leaves()
    {
        return $this->hasMany(Leave::class, 'user_id', 'id');
    }

    /**
     * @return hasMany
     */
    public function scores()
    {
        return $this->hasMany(Score::class);
    }

    /**
     *
     * @return hasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }

    /**
     *
     * @return hasMany
     */
    public function commentReplies()
    {
        return $this->hasMany(CommentReply::class, 'user_id', 'id');
    }

    /**
     * @return hasMany
     */
    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'user_id', 'id');
    }

    /**
     * @return hasMany
     */
    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'user_id', 'id');
    }

    /**
     * @return hasMany
     */
    public function notifies()
    {
        return $this->hasMany(Notify::class);
    }

    /**
     * @return hasMany
     */
    public function documents()
    {
        return $this->hasMany(Document::class, 'user_id', 'id');
    }

    /**
     * getRole function
     * @return mixed
     */
    public function getRole()
    {
        return optional($this)->role;
    }
}
