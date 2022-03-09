<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Services\AttendanceService;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    private AttendanceService $attendanceService;

    /**
     * AttendanceController Constructor
     * @param AttendanceService $attendanceService
     */
    public function __construct(AttendanceService $attendanceService)
    {
        $this->attendanceService = $attendanceService;
    }

    /**
     * getInfoLesson function
     * @param Request $request
     * @return mixed
     */
    public function getInfoLesson(Request $request)
    {
        return $this->attendanceService->teacherGetInfoLesson($request);
    }

    // public function checkStateLesson($lessonId)
    // {
    //     return $this->attendanceService->checkStateLesson($lessonId);
    // }

    public function turnOnAttendance(Request $request)
    {
        return $this->attendanceService->teacherTurnOnAttendance($request);
    }

    public function turnOffAttendance($lessonId)
    {
        return $this->attendanceService->teacherTurnOffAttendance($lessonId);
    }
}
