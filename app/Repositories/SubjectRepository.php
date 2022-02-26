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
        // return $this->model
        //     ->select('subjects.name', 'schedules.id', 'schedules.date_start')
        //     ->where('class_id', $classId)
        //     ->where('semester', $semester)
        //     ->join('subjects', 'subjects.id', '=', 'schedules.subject_id')
        //     ->get();

        return 'ok';
    }

    
}
