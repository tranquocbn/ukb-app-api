<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\LeaveService;

class LeaveController extends Controller
{
    private LeaveService $leaveService;

    /**
     * UserController Constructor
     * @param LeaveService $LeaveService
     */
    public function __construct(LeaveService $leaveService)
    {
        $this->leaveService = $leaveService;
    }

    public function checkDate(Request $request)
    {
        return $this->leaveService->checkDateLeaveEnable($request);
    }

    public function create(Request $request)
    {
        return $this->leaveService->studentCreate($request);
    }

}
