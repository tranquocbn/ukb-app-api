<?php

namespace App\Services;

use App\Repositories\LeaveRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\ScheduleRepository;
class ScheduleService extends BaseService
{
    protected ScheduleRepository $scheduleRepository;
    protected LeaveRepository $leaveRepository;

    /**
     * @param ScheduleRepository $scheduleRepository
     * @param LeaveRepository $leaveRepository
     */
    public function __construct(
        ScheduleRepository $scheduleRepository,
        LeaveRepository $leaveRepository
    )
    {
        $this->scheduleRepository = $scheduleRepository;
        $this->leaveRepository = $leaveRepository;
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

        // $date = '2019-06-22';
        $date = '2019-07-15';
        $session = 1;

        $test = $this->leaveRepository->getDateWant($userId, $date);
        $schedule = $this->scheduleRepository->checkSchedule($userId, $date, $session);
        dd($schedule);
        if(!$schedule) {
            return $this->resSuccessOrFail(null, trans('text.attendance.check_schedule'));
        }
        $info = $this->scheduleRepository
                    ->getInfoLesson($userId, $schedule->id, $date );
        return $info[0];
    }
}

