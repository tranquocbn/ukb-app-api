<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\AttendanceRepository;
use App\Repositories\LessonRepository;

class AttendanceService extends BaseService
{
    private AttendanceRepository $attendanceRepository;
    private LessonRepository $lessonRepository;
    /**
     * @param AttendanceRepository $attendanceRepository
     * @param LessonRepository $lessonRepository
     */
    public function __construct(
        AttendanceRepository $attendanceRepository,
        LessonRepository $lessonRepository
    )
    {
        $this->attendanceRepository = $attendanceRepository;
        $this->lessonRepository = $lessonRepository;
    }

    /**
     * teacherTurnOnAttendance function
     * @param Request $request
     * @return mixed
     */
    public function teacherTurnOnAttendance(Request $request)
    {
        $dt = now('Asia/Ho_Chi_Minh');
        $time = date_format($dt,"H");

        $lessonId = $request->lesson_id;
        $state = $this->lessonRepository->checkStateLesson($lessonId)->toArray();
        
        if($time < 8 || $time > 16) {
            return $this->resSuccessOrFail(null, trans('text.attendance.error_attendance'));
        }

        if($state[0] != 2) {
            $data = $request->merge(['lessonId' => $lessonId])->toArray();
            $this->lessonRepository->teacherTurnOnAttendance($data);
            // $this->attendanceRepository->insertStudent($request->lesson_id, $request->class_id);

            return $this->resSuccessOrFail(null, trans('text.attendance.turn_on_attendance'));
        }
    }

    /**
     * teacherTurnOffAttendance function
     * @param $lessonId
     * @return mixed
     */
    public function teacherTurnOffAttendance($lessonId)
    {
        $state = $this->lessonRepository->checkStateLesson($lessonId)->toArray();
        
        if($state[0] == 2) {
            $run = $this->lessonRepository->teacherTurnOffAttendance($lessonId);
            if($run)
                return $this->resSuccessOrFail(null, trans('text.attendance.turn_off_attendance'));
        }
    }

    /**
     * studentAttendance function
     * @param Request $request
     * @return mixed
     */
    public function studentAttendance(Request $request)
    {
        $userId = $request->user()->id;
        $device = $request->device;
        $lessonId = $request->lesson_id;
        $stateLesson = $this->lessonRepository->checkStateLesson($lessonId)->toArray();

        if($stateLesson[0] != 2) {
            return $this->resSuccessOrFail(null, trans('text.attendance.is_not_on'), Response::HTTP_METHOD_NOT_ALLOWED);
        }

        $state = $this->attendanceRepository->checkStateAttendance($userId, $lessonId)->toArray();

        if($state[0] != 1) {
            $attendance = $this->attendanceRepository->studentAttendance($userId, $lessonId, $device);
            if($attendance) {
                return $this->resSuccessOrFail(null, trans('text.attendance.successfully'));
            }
            return $this->resSuccessOrFail(null, trans('text.attendance.fail'), Response::HTTP_METHOD_NOT_ALLOWED);
        }
    }
}
