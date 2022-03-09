<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\AttendanceRepository;
use App\Repositories\LeaveRepository;
use App\Repositories\LessonRepository;
use App\Repositories\ScheduleRepository;

class AttendanceService extends BaseService
{
    private AttendanceRepository $attendanceRepository;
    private LeaveRepository $leaveRepository;
    private ScheduleRepository $scheduleRepository;
    private LessonRepository $lessonRepository;
    /**
     * @param AttendanceRepository $attendanceRepository
     * @param LessonRepository $lessonRepository
     * @param ScheduleRepository $scheduleRepository
     * @param LessonRepository $lessonRepository
     */
    public function __construct(
        AttendanceRepository $attendanceRepository,
        LeaveRepository $leaveRepository,
        ScheduleRepository $scheduleRepository,
        LessonRepository $lessonRepository
    )
    {
        $this->attendanceRepository = $attendanceRepository;
        $this->leaveRepository = $leaveRepository;
        $this->scheduleRepository = $scheduleRepository;
        $this->lessonRepository = $lessonRepository;
    }

    /**
     * teacherGetInfoLesson function
     * @param Request $request
     * @return mixed
     */
    public function teacherGetInfoLesson(Request $request)
    {
        $userId = $request->user()->id;
        $dt = now('Asia/Ho_Chi_Minh');
        $date = date_format($dt,"Y-m-d");
        $time = date_format($dt,"H");
        $session = 0;

        if($time >= 8 && $time <= 12) {
            $session = 1;
        } 
        if($time >= 13 && $time <= 16) {
            $session = 2;
        }

        $date = '2019-06-29';
        // $date = '2019-07-13';
        $session = 1;

        $dateWant = $this->leaveRepository->getDateWant($userId, $date)->toArray();

        if(!$dateWant) {
            $schedule = $this->scheduleRepository->checkSchedule('user_id', $userId, $date, $session)->toArray();
            $scheduleId = $schedule[0]['id'];
            
            if(!$scheduleId) {
                return $this->resSuccessOrFail(null, trans('text.attendance.check_schedule'), Response::HTTP_NOT_FOUND);
            }

            $lessons = $this->lessonRepository->getInfoLesson($scheduleId)->toArray();

            foreach ($lessons as $lesson){
                if($lesson['date_learn'] === $date){
                    return array_merge($lesson, ['count' => count($lessons)]);
                };
            }
        }
        return $this->resSuccessOrFail(null, trans('text.attendance.check_schedule'), Response::HTTP_NOT_FOUND);
    }

    /**
     * teacherTurnOnAttendance function
     * @param Request $request
     * @return mixed
     */
    public function teacherTurnOnAttendance(Request $request)
    {
        $data = $request->merge(['lessonId' => $request->lesson_id])->toArray();
        $this->lessonRepository->teacherTurnOnAttendance($data);

        return $this->attendanceRepository->insertStudent($request->lesson_id, $request->class_id);
        return $this->resSuccessOrFail(null, trans('text.attendance.turn_on_attendance'));
    }

    /**
     * teacherTurnOffAttendance function
     * @param $lessonId
     * @return mixed
     */
    public function teacherTurnOffAttendance($lessonId)
    {
        $run = $this->lessonRepository->teacherTurnOffAttendance($lessonId);
        if($run)
            return $this->resSuccessOrFail(null, trans('text.attendance.turn_off_attendance'));
    }

    /**
     * studentAttendance function
     * @param Request $request
     * @return mixed
     */
    public function studentAttendance(Request $request, $lessonId)
    {
        $userId = $request->user()->id;
        $device = $request->device;
        $state = $this->lessonRepository->checkStateLesson($lessonId)->toArray();
        
        if($state[0] != 2) {
            return $this->resSuccessOrFail(null, trans('text.attendance.is_not_on'), Response::HTTP_METHOD_NOT_ALLOWED);
        }

        $attendance = $this->attendanceRepository->studentAttendance($userId, $lessonId, $device);
        if($attendance) {
            return $this->resSuccessOrFail(null, trans('text.attendance.successfully'));
        }
        return $this->resSuccessOrFail(null, trans('text.attendance.fail'), Response::HTTP_METHOD_NOT_ALLOWED);
    }
}
