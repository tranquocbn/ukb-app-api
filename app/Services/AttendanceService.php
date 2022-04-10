<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\AttendanceRepository;
use App\Repositories\LessonRepository;
use App\Traits\DateCalculateTrait;
class AttendanceService extends BaseService
{
    use DateCalculateTrait;
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
        $date = $this->getDateCurrent();
        $time = $date['time'];

        $lessonId = $request->lesson_id;
        $state = $request->state;
        
        if($time < 8 || $time > 16) {
            return $this->resSuccessOrFail(null, trans('text.attendance.error_attendance'));
        }

        if($state != 2) {
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
    public function teacherTurnOffAttendance($lessonId, $state)
    {
        if($state == 2) {
            $run = $this->lessonRepository->teacherTurnOffAttendance($lessonId);
            if($run)
                $this->attendanceRepository->delete($lessonId);
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
        $lessonId = $request->lessonId;
        $stateLesson = $request->stateLesson;
        $uuid_device = $request->uuid_device;

        if($stateLesson != 2) {
            return $this->resSuccessOrFail(null, trans('text.attendance.is_not_on'), Response::HTTP_METHOD_NOT_ALLOWED);
        }

        $state = $this->attendanceRepository->checkStateAttendance($userId, $lessonId)->toArray();

        if($state[0] != 1) {
            $attendance = $this->attendanceRepository->studentAttendance($userId, $lessonId, $uuid_device);
            if($attendance) {
                $infoLesson = $this->lessonRepository->getInfoLesson($lessonId);
                return $this->resSuccessOrFail(['info' =>$infoLesson], trans('text.attendance.successfully'));
            }
            return $this->resSuccessOrFail(null, trans('text.attendance.fail'), Response::HTTP_METHOD_NOT_ALLOWED);
        }
    }
}
