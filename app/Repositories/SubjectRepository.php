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
    public function getSubjectsStudent(string $field, int $id, int $semester)
    {
        return $this->model
        ->with(['schedules' => function($e) use ($field, $id, $semester) {
            $e->select('id', 'user_id', 'class_id', 'subject_id', 'room_id', 'date_start')
            ->where($field, $id)
            ->where('semester', $semester)
            ->withCount('lessons');
        }])
        ->whereHas('schedules', function($e) use ($field, $id, $semester) {
            $e->where($field, $id)
            ->where('semester', $semester);
        })
        ->get();
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
