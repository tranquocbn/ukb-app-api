<?php

namespace App\Services;

use App\Repositories\AttendanceRepository;
use App\Repositories\LeaveRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\ScheduleRepository;

class ScheduleService extends BaseService
{
    protected ScheduleRepository $scheduleRepository;
    protected LeaveRepository $leaveRepository;
    protected AttendanceRepository $attendanceRepository;
    /**
     * @param ScheduleRepository $scheduleRepository
     * @param LeaveRepository $leaveRepository
     * @param AttendanceRepository $attendanceRepository
     */
    public function __construct(
        ScheduleRepository $scheduleRepository,
        LeaveRepository $leaveRepository,
        AttendanceRepository $attendanceRepository
    )
    {
        $this->scheduleRepository = $scheduleRepository;
        $this->leaveRepository = $leaveRepository;
        $this->attendanceRepository = $attendanceRepository;
    }

    /**
     * get info getInfoLesson
     * @param Request $request
     * @return 
     */
    public function getInfoLesson(Request $request)
    {
        $userId   = $request->user()->id;
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

        $date = '2019-06-29';
        // $date = '2019-07-13';
        $session = 1;

        $dateWant = $this->leaveRepository->getDateWant($userId, $date)->toArray();

        if(!$dateWant) {
            $schedule = $this->scheduleRepository->checkSchedule($userId, $date, $session);

            if(!$schedule) {
                return $this->resSuccessOrFail(null, trans('text.attendance.check_schedule'), Response::HTTP_NOT_FOUND);
            }

            $info = $this->scheduleRepository->getInfoLesson($userId, $schedule[0], $date)->toArray();
            
            $lessonId = $info[0]['lessons'][0]['id'];
            $countStudent = $this->attendanceRepository->countStudent($lessonId);

            return $info;
        }

        return $this->resSuccessOrFail(null, trans('text.attendance.check_schedule'), Response::HTTP_NOT_FOUND);
    }
}

