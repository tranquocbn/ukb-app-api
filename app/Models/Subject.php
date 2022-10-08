<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
   use HasFactory;

   protected $table = 'subjects';
   protected $fillable = [
      'code',
      'name',
      'credit'
   ];

   /**
    * @return hasMany
    */

   public function schedules()
   {
      return $this->hasMany(Schedule::class, 'subject_id', 'id');
   }

   /**
   * @return belongsToMany
   */
   public function teachers()
   {
      return $this->belongsToMany(User::class, 'schedules', 'subject_id', 'user_id');
   }

      /**
   * @return belongsToMany
   */
   public function classes()
   {
      return $this->belongsToMany(Classroom::class, 'schedules', 'subject_id', 'class_id');
   }

   /**
   * @return belongsToMany
   */
   public function rooms()
   {
      return $this->belongsToMany(Room::class, 'schedules', 'subject_id', 'room_id');
   }
}
