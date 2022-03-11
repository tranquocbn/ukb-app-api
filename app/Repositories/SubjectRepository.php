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

   public function getSubjectsSemesterStudent(array $data)
   {
       return 'ok';
   }
     
   public function teacherGetSubjects(array $data)
   {
       return $this->model
           ->with('schedules:id,subject_id')
           ->whereHas('schedules', function($e) use ($data) {
               $e->where('user_id', $data['user_id'])
                ->whereYear('date_start', $data['year'])
                ->whereRaw('semester % 2 = ?', [$data['semester']]);
           })
           ->get();
   }
    
}
