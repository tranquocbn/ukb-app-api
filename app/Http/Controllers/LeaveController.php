<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
// use App\Services\UserService;
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

    /**
     * get subjects in semester
     * 
     * 
     * @return mixed
     */
    public function getSubjectsInSemesterCurrent(Request $request)
    {
        return $this->leaveService->getSubjectsInSemesterCurrent($request);
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
