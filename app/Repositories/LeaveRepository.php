<?php
namespace App\Repositories;

use App\Models\Leave;
use Illuminate\Support\Facades\DB;

class LeaveRepository extends BaseRepository{

    public function model()
    {
        return Leave::class;
    }

    /**
     * countLeaveStudent function
     *
     * @param integer $scheduleId
     * @param integer $studentId
     * @return mixed
     */
    public function countLeaveStudent(int $scheduleId, int $studentId)
    {
        return $this->model
        ->where('schedule_id', $scheduleId)
        ->where('user_id', $studentId)
        ->count();
    }

    /**
     * getLeavesStudent function
     *
     * @param integer $userId
     * @param integer $yearLearn
     * @param integer $semester
     * @return mixed
     */
    public function getLeavesStudent(int $userId, int $yearLearn, int $semester)
    {
        return $this->model
        ->where('user_id', $userId)
        ->whereYear('date_want', $yearLearn)
        ->when($semester == SEMESTER_1, function($e) {
            $e->whereMonth('date_want', '>=', START_SEMESTER_1)
            ->orWhereMonth('date_want', '<=', END_SEMESTER_1);
        },
        function($e) {
            $e->whereMonth('date_want', '>=', START_SEMESTER_2)
            ->orWhereMonth('date_want', '<=', END_SEMESTER_2);
        })
        ->with(['schedule'=> fn($e) => $e->with('subject:id,name')])
        ->get();
    }

    /**
     * getLeavesTeacher function
     *
     * @param integer $userId
     * @param integer $yearLearn
     * @param integer $semester
     * @return mixed
     */
    public function getLeavesTeacher(int $userId, int $yearLearn, int $semester)
    {
        return $this->model
        ->where('user_id', $userId)
        ->whereYear('date_want', $yearLearn)
        ->when($semester == SEMESTER_1, function($e) {
            $e->whereMonth('date_want', '>=', START_SEMESTER_1)
            ->orWhereMonth('date_want', '<=', END_SEMESTER_1);
        },
        function($e) {
            $e->whereMonth('date_want', '>=', START_SEMESTER_2)
            ->orWhereMonth('date_want', '<=', END_SEMESTER_2);
        })
        ->with(['schedule'=> function($e) {
            $e->with('subject:id,name')
            ->with('class:id,name');
        }])
        ->get();
    }
    /**
     * teacher get date want 
     * @param $userId, $date
     * @return mix
     */
    public function getDateWant($userId, $date)
    {
        return $this->model
            ->where('user_id', $userId)
            ->where('date_want', $date)
            ->get();
    }

    /**
     * check date select student
     *
     * @param array $data
     * @return mix
     */
    public function checkDateLeaveEnable(array $data)
    {
        //dung: null, sai: co dl
        return $this->model->select("*")
        ->where('user_id', $data['teacher_id'])
        ->where('schedule_id', $data['schedule_id'])
        ->when($data['date_diff'] % 7 == 0, function($e) use ($data) {
            $e->where('date_want', $data['date_selected']);
        }, function($e) use ($data) {
            $e->where('date_change', '<>', $data['date_selected']);
        })->get();
    }

    public function studentLeavesSemester(array $data)
    {
        return $this->model
        ->where('user_id', $data['user_id'])
        ->where('schedule_id', $data['schedule_id'])
        ->get();
    }


}

