<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Requests\Teacher\CreateLeaveRequest;
use App\Services\LeaveService;
use App\Http\Controllers\Controller;

class LeaveController extends Controller
{
    private LeaveService $leaveService;

    /**
     * @param LeaveService $LeaveService
     */
    public function __construct(LeaveService $leaveService)
    {
        $this->leaveService = $leaveService;
    }

    /**
     * create leave function
     * @param CreateLeaveRequest $request
     * @return mixed
     */
    public function store(CreateLeaveRequest $request)
    {
        return $this->leaveService->createTeacher($request);
    }
    
    /**
     * getYearsLearn function
     *
     * @return mixed
     */
    public function getYearsLearn()
    {
        return $this->leaveService->getYears();
    }

    /**
     * getLeaves function
     *
     * @param Request $request
     * @return mixed
     */
    public function getLeaves(Request $request)
    {
        return $this->leaveService->getLeaves($request);
    }

    /**
     * get subjects in semester
     * 
     * 
     * @return mixed
     */
    public function getSubjectsInSemesterCurrent(Request $request)
    {
        // return $this->leaveService->getSubjectsInSemesterCurrent($request);
    }

    public function dateLearn(Request $request)
    {
        return 'ok';
    }


}
