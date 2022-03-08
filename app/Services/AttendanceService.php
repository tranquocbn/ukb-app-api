<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\AttendanceRepository;
use App\Repositories\LessonRepository;
class AttendanceService extends BaseService
{
    protected AttendanceRepository $attendanceRepository;
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

    public function attendance(Request $request)
    {
        $userId = $request->user()->id;
        $lessonId = $request->lessonId;
        $device = $request->device;
        $state = $this->lessonRepository->checkStateLesson($lessonId)->pluck('state')->toArray();
        
        if($state[0] != 2) {
            return $this->resSuccessOrFail(null, trans('text.attendance.is_not_on'), Response::HTTP_METHOD_NOT_ALLOWED);
        }

        $attendance = $this->attendanceRepository->attendance($userId, $lessonId, $device);
        if($attendance) {
            return $this->resSuccessOrFail(null, trans('text.attendance.successfully'));
        }
        return $this->resSuccessOrFail(null, trans('text.attendance.fail'), Response::HTTP_METHOD_NOT_ALLOWED);
    }
}
