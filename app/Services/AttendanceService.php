<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\AttendanceRepository;
use Carbon\Carbon;

class AttendanceService extends BaseService
{
    protected AttendanceRepository $attendanceRepository;

    /**
     * @param AttendanceRepository $attendanceRepository
     */
    public function __construct(AttendanceRepository $attendanceRepository)
    {
        $this->attendanceRepository = $attendanceRepository;
    }

    public function getInfoLesson(Request $request)
    {
        $user_code  = $request->code;
        $dt         = Carbon::now('Asia/Ho_Chi_Minh');
        $date       = $dt->toDateString(); 
        $time       = $dt->hour;

        if($time >= 8 && $time <= 11) {
            $session = 1;
        } elseif($time >= 13 && $time <= 16) {
            $session = 2;
        } else {
            $session = 1;
        }

        $schedule_id = $this->attendanceRepository
                           ->checkSchedule($user_code, '2022-02-12', $session);
        
        if(!$schedule_id) {
            return $this->resSuccessOrFail(null, trans('text.attendance.check_schedule'), Response::HTTP_UNAUTHORIZED);
        } else {
            return $this->attendanceRepository
                        ->getInfoLesson($user_code, 1, '2022-02-12');
        }
    }
}
