<?php
namespace App\Repositories;

use App\Models\Attendance;
class AttendanceRepository extends BaseRepository
{
    /**
     * @var Attendance
     */

    protected Attendance $attendance;

    public function model()
    {
        return Attendance::class;
    }

    /**
     * count student of lesson
     * @param $lessonId
     * @return mixed
     */
    public function countStudent($lessonId)
    {
        return $this->model->where('lesson_id', $lessonId)->count();
    }

    /**
     * student attendance function
     * @param $userId, $lessonId
     * @return mixed
     */
    public function attendance($userId, $lessonId, $device)
    {
        return $this->model
                    ->where('lesson_id', $lessonId)
                    ->where('user_id', $userId)
                    ->where('device', $device)
                    ->update(['state'=> 1]);
    }
}