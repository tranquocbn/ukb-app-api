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
    protected LeaveRepository $leaveRepository;
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
        LeaveRepository $leaveRepository,
        AttendanceRepository $attendanceRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->scheduleRepository = $scheduleRepository;
        $this->leaveRepository = $leaveRepository;
        $this->attendanceRepository = $attendanceRepository;
    }

    /**
     * inputData function
     * @param Request $request
     * @return 
     */
    public function inputData(Request $request)
    {
        $userId = $request->user()->id;
        $dt = now('Asia/Ho_Chi_Minh');
        $date = date_format($dt,"Y-m-d");
        $time = date_format($dt,"H");
        
        if($time <= 11) {
            $session = 1;
        } 

        if($time >= 13) {
            $session = 2;
        } 

        return [
                'id' => $userId,
                'date' => $date,
                'session' => $session
        ];
    }

    /**
     * getInfoLesson for teacher function
     * @param Request $request
     * @return 
     */
    public function getInfoLesson(Request $request)
    {
        $data = $this->inputData($request);
        $teacherId = $data['id'];
        $date = $data['date'];
        $session = $data['session'];

        $date = '2019-06-29';
        $session = 1;

        $dateWant = $this->leaveRepository->getDateWant($teacherId, $date)->toArray();

        if(!$dateWant) {
            $schedule = $this->scheduleRepository->checkSchedule('user_id', $teacherId, $date, $session);

            if(!$schedule) {
                return $this->resSuccessOrFail(null, trans('text.attendance.check_schedule'), Response::HTTP_NOT_FOUND);
            }

            $info = $this->scheduleRepository->getInfoLesson($teacherId, $schedule[0], $date)->toArray();
            
            $lessonId = $info[0]['lessons'][0]['id'];
            $countStudent = $this->attendanceRepository->countStudent($lessonId);

            return $info;
        }
        return $this->resSuccessOrFail(null, trans('text.attendance.check_schedule'), Response::HTTP_NOT_FOUND);
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

            $info = $this->scheduleRepository->getInfoLesson($userId, $schedule[0], $date)->toArray();
            
            $lessonId = $info[0]['lessons'][0]['id'];
            $countStudent = $this->attendanceRepository->countStudent($lessonId);

            return $info;
        }
        return $this->resSuccessOrFail(null, trans('text.attendance.check_schedule'), Response::HTTP_NOT_FOUND);
    }
}

