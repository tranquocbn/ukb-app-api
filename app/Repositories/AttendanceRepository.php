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
        $data = DB::table('users')
        ->selectRaw("(array)(id AS user_id, $lessonId AS lesson_id)")
        ->where('userable_id', $classId)
        ->where('role_id', 2)
        ->get();
        // dd($data->toArray());
        return $this->model
            ->insert( $data->toArray());
       
           
    }
    /**
     * studentAttendance function
     * @param $userId, $lessonId
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