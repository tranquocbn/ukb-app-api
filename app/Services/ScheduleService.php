<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\ScheduleRepository;

class ScheduleService extends BaseService
{
    protected ScheduleRepository $scheduleRepository;

    /**
     * @param ScheduleRepository $scheduleRepository
     */
    public function __construct(ScheduleRepository $scheduleRepository)
    {
        $this->scheduleRepository = $scheduleRepository;
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

        $date = '2019-06-22';
        // $date = '2019-07-13';
        $session = 1;

        $schedule = $this->scheduleRepository
                             ->checkSchedule($userId, $date, $session);
                             return $schedule;
        if(!$schedule) {
            return $this->resSuccessOrFail(null, trans('text.attendance.check_schedule'), Response::HTTP_UNAUTHORIZED);
        }
        
        return $this->scheduleRepository
                    ->getInfoLesson($userId, $schedule[0]['id'], $date );
    }
}

