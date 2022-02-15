<?php
namespace App\Repositories;

use App\Models\User;
use App\Models\Leave;
use App\Models\Subject;
use App\Models\Schedule;

class LeaveRepository {

    /**
     * @var User
     */

     protected User $user;
     protected Leave $leave;
     protected Subject $subject;
     protected Schedule $schedule;

     public function __construct(
         User $user, 
         Leave $leave,
         Subject $subject,
         Schedule $schedule
    )
     {
        $this->user = $user;
        $this->leave = $leave;
        $this->subject = $subject;
        $this->schedule = $schedule;
     }

     /**
      * get subjects in semester current
      * 
      */
     public function getSubjectsInSemesterCurrent($classId, $semester)
     {
         return $this->schedule
                ->whereClassId($classId)
                ->whereSemester($semester)->get();
     }

}