<?php
namespace App\Repositories;

use App\Models\Attendance;
use Illuminate\Support\Facades\DB;
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
     * insertStudent function
     * @param $lessonId, $classId
     * @return mixed
     */
    public function insertStudent($lessonId, $classId)
    {
        return $this->model
            ->insert(
                (array) DB::table('users')
                        ->selectRaw("id AS user_id, $lessonId AS lesson_id")
                        ->where('userable_id', $classId)
                        ->where('role_id', 2)
                        ->get()
            ); 
    }

    /**
     * delete function
     *
     * @param [type] $lessonId
     * @return 
     */
    public function delete($lessonId)
    {
        return $this->model
                ->where('lesson_id', $lessonId)
                ->delete();
    }
    /**
     * check student isExist
     *
     * @param userId
     * @return mixed
     */
    public function isExist($userId)
    {
        return $this->model
                ->where('user_id', $userId)
                ->get();
    }
    /**
     * checkStateAttendance function
     * @param $userId, $lessonId
     * @return mixed
     */
    public function checkStateAttendance($userId, $lessonId)
    {
        return $this->model
            ->select('state')
            ->where('user_id', $userId)
            ->where('lesson_id', $lessonId)
            ->get();
    }

    /**
     * studentAttendance function
     * @param $userId, $lessonId, $device
     * @return mixed
     */
    public function studentAttendance($userId, $lessonId, $device)
    {
        return $this->model
                    ->where('lesson_id', $lessonId)
                    ->where('user_id', $userId)
                    ->where('device', $device)
                    ->update(['state'=> 1]);
    }
}