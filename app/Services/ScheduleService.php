<?php

namespace App\Services;

use App\Repositories\AttendanceRepository;
use App\Repositories\LeaveRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\ScheduleRepository;
use App\Repositories\UserRepository;

class ScheduleService extends BaseService
{
    protected UserRepository $userRepository;
    protected ScheduleRepository $scheduleRepository;
    protected AttendanceRepository $attendanceRepository;
    /**
     * @param UserRepository $userRepository
     * @param ScheduleRepository $scheduleRepository
     * @param LeaveRepository $leaveRepository
     * @param AttendanceRepository $attendanceRepository
     */
    public function __construct(
        UserRepository $userRepository,
        ScheduleRepository $scheduleRepository,
        AttendanceRepository $attendanceRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->scheduleRepository = $scheduleRepository;
        $this->leaveRepository = $leaveRepository;
        $this->attendanceRepository = $attendanceRepository;
    }

    

    /**
     * getInfoLesson for teacher function
     * @param Request $request
     * @return 
     */
    public function getInfoLesson(Request $request)
    {
        
    }

    /**
     * getInfoLesson for student function
     * @param Request $request
     * @return 
     */
    public function getInfoLessonOfStudent(Request $request)
    {
        $data = $this->inputData($request);
        $userId = $data['id'];
        $date = $data['date'];
        $session = $data['session'];
        $classId = $this->userRepository->getIdClass($userId);

        $date = '2019-06-29';
        $session = 1;
        $isLeave = $this->scheduleRepository->isLeave($classId, $date)->toArray();

        if(!$isLeave) {
            $schedule = $this->scheduleRepository->checkSchedule('class_id',$classId, $date, $session)->toArray();
           
            if(!$schedule) {
                return $this->resSuccessOrFail(null, trans('text.attendance.check_schedule'), Response::HTTP_NOT_FOUND);
            }

            $info = $this->scheduleRepository->getInfoLesson('class_id', $classId, $schedule[0], $date)->toArray();
            return $info;
        }
        return $this->resSuccessOrFail(null, trans('text.attendance.check_schedule'), Response::HTTP_NOT_FOUND);
    }
}

