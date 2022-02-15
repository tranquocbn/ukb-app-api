<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\AttendanceRepository;

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
        $userCode   = $request->code;
        $dt         = now('Asia/Ho_Chi_Minh');
        $date       = date_format($dt,"Y-m-d");
        $time       = date_format($dt,"H");

        if($time >= 8 && $time <= 11) {
            $session = 1;
        } elseif($time >= 13 && $time <= 16) {
            $session = 2;
        } else {
            $session = 1;
        }

        $scheduleId = $this->attendanceRepository
                           ->checkSchedule($userCode, '2022-02-12', 1);
        if(!$scheduleId) {
            return $this->resSuccessOrFail(null, trans('text.attendance.check_schedule'), Response::HTTP_UNAUTHORIZED);
        }
        return $this->attendanceRepository
                    ->getInfoLesson($userCode, 1, '2022-02-12');
    }
}
