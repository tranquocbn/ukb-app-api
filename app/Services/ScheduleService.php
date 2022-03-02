<?php

namespace App\Services;

use App\Repositories\LeaveRepository;
use App\Repositories\LessonRepository;
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
     * @param LessonRepository $leaveRepository
     */
    public function __construct(
        ScheduleRepository $scheduleRepository,
        LeaveRepository $leaveRepository,
        LessonRepository $lessonRepository
    )
    {
        $this->scheduleRepository = $scheduleRepository;
        $this->leaveRepository = $leaveRepository;
        $this->$lessonRepository = $lessonRepository;
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

        $dateWant = $this->leaveRepository->getDateWant($userId, $date)->toArray();

        if(!$dateWant) {
            $schedule = $this->scheduleRepository->checkSchedule($userId, $date, $session);

            if(!$schedule) {
                return $this->resSuccessOrFail(null, trans('text.attendance.check_schedule'), Response::HTTP_NOT_FOUND);
            }
            $info = $this->scheduleRepository->getInfoLesson($userId, $schedule[0], $date);
            
            $data = $info->merge(['students_count' => $this->lessonRepository->countStudent()]);
            return $info[0];
        }

        return $this->resSuccessOrFail(null, trans('text.attendance.check_schedule'), Response::HTTP_NOT_FOUND);
    }
}

