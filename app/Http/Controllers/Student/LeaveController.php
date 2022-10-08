<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\LeaveService;
use App\Http\Requests\Student\CreateLeaveRequest;
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
     * check student date selected
     *
     * @param Request $request
     * @return mix
     */
    public function checkDate(Request $request)
    {
        return $this->leaveService->checkDateLeaveEnable($request);
    }

    /**
     * student create leave function
     * @param CreateLeaveRequest $request
     * @return mixed
     */
    public function store(CreateLeaveRequest $request)
    {
        return $this->leaveService->storeStudent($request);
    }


    public function leavesSemester(Request $request)
    {
        return $this->leaveService->studentLeavesSemester($request);
    }

}
