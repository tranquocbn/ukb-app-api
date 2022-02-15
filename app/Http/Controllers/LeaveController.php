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
    public function getSubjectsInSemesterCurrent(Request $req)
    {
        return $this->leaveService->getSubjectsInSemesterCurrent($req);
    }


     /**
     * login function
     *
     * @param LoginRequest $request
     * @return mixed
     */
    public function login(LoginRequest $request)
    {
       return $this->userService->login($request);
    }
}
