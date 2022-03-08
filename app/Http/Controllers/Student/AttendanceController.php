<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\AttendanceService;

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


    public function getInfoLesson(Request $request)
    {
    //    return $this->attendanceService->studentGetInfoLesson($request);
    }

    public function attendance(Request $request, $lessonId)
    {
        return $this->attendanceService-> studentAttendance($request, $lessonId);
    }
}
