<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
// use App\Services\UserService;
use App\Services\LeaveService;
use App\Http\Controllers\Controller;

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

    /**
     * get subjects in semester
     * 
     * 
     * @return mixed
     */
    public function getSubjectsInSemesterCurrent(Request $request)
    {
        return 'ok';
        // return $this->leaveService->getSubjectsInSemesterCurrent($request);
    }

    /**
     * checkDate
     * 
     * 
     */
    public function checkDate(Request $request)
    {
        return 'ok';
    }


}
