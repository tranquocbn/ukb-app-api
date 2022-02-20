<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    /**
     * getInfoLesson function
     *
     * @param LoginRequest $request
     * @return mixed
     */
    public function getInfoLesson(Request $request)
    {
        return $this->attendanceService->getInfoLesson($request);
    }

    public function turnOnAttendance(Request $request)
    {
        return $this->attendanceService->checkStateAttendance($request);
    }
}
