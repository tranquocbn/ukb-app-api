<?php

namespace App\Repositories;

use App\Models\Schedule;
use App\Models\Subject;

use Illuminate\Support\Facades\DB;
class SubjectRepository extends BaseRepository
{

    public function model()
    {
        return Subject::class;
    }
    
    /**
     * get subjects in semester current
     * @return mixed
     */
    public function getSubjectsInSemesterCurrent($classId, $semester)
    {
        return $this->model
                ->whereHas('schedules', function($e) use ($classId, $semester) {
                    $e->where('class_id', $classId)
                    ->where('semester', $semester);
                })
                ->with(['schedules' => function($e) {
                    $e->select('id', 'user_id', 'class_id', 'subject_id', 'room_id', 'date_start')
                    ->withCount('lessons');
                }])
                ->get();
    }

    /**
     * get subjects of student in schedule
     *
     * @param int $classId
     * @return mix
     */
   public function getSubjectsScheduleStudent(int $classId)
   {
       return $this->model
       ->whereHas('schedules', function($e) use ($classId) {
           $e->where('class_id', $classId);
       })
       ->with(['schedules' => function($e) use ($classId) {
            $e->select('id','subject_id', 'semester', 'user_id', 'date_start')
            ->where('class_id', $classId);
       }])
       ->get();
   }

    
}
