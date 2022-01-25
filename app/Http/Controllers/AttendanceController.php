<?php

namespace App\Http\Controllers;

use App\Services\AttendanceService;
use Illuminate\Http\Request;


class AttendanceController extends Controller
{
    private AttendanceService $attendanceService;

    /**
     * UserController Constructor
     * @param UserService $userService
     */
    public function __construct(AttendanceService $attendanceService)
    {
        $this->attendanceService = $attendanceService;
    }

    public function attendance(Request $request) 
    {
        $user_code = '08d4800021';
        $class_code = '08dCNTT02';
        $info = $this->userService->getInfoLesson($user_code, $class_code);

        if($request->wantsJson()) {
            return $this->responseSuccess($info, '');
        }
        return $info;
    }
}
