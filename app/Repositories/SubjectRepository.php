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
        //muốn lây: schedule_id, count_lesson
        return $this->model
                ->select('id', 'name')
                ->whereHas('schedules', function($e) use ($classId, $semester) {
                        $e->where('class_id', $classId)
                        ->where('semester', $semester);
                })
                ->get();
    }

    
}
