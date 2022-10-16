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
     * get subjects in semester current function
     *
     * @param string $field
     * @param integer $classId
     * @param integer $semester
     * @return mixed
     */
    public function getSubjectsByStudent(int $classId, int $semester)
    {
        return $this->model
        ->with(['schedules' => function($e) use ($classId, $semester) {
            $e->select('id', 'user_id', 'class_id', 'subject_id', 'room_id', 'date_start')
            ->where('class_id', $classId)
            ->where('semester', $semester)
            ->withCount('lessons');
        }])
        ->whereHas('schedules', function($e) use ($classId, $semester) {
            $e->where('class_id', $classId)
            ->where('semester', $semester);
        })
        ->get();
    }

    /**
     * get Subjects and Classes current by teacher function
     *
     * @param integer $teacherId
     * @param integer $monthStart
     * @return mixed
     */
    public function getSubjectsClasses(int $teacherId, int $monthStart)
    {
        return $this->model
        ->with(['schedules' => function($e) use ($teacherId, $monthStart) {
            $e->select('id', 'user_id', 'class_id', 'subject_id', 'room_id', 'date_start')
            ->where('user_id', $teacherId)
            ->whereYear('date_start', date('Y'))
            ->whereMonth('date_start', $monthStart)
            ->with(['class']);
        }])
        ->whereHas('schedules', function($e) use ($teacherId, $monthStart) {
            $e->where('user_id', $teacherId)
            ->whereYear('date_start', date('Y'))
            ->whereMonth('date_start', $monthStart)
            ->has('class');
        })
        ->get();
    }
}
