<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\LeaveService;
use App\Http\Requests\Student\CreateLeaveRequest;
use App\Http\Requests\UpdateLeaveRequest;

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
     * create leave function
     * @param CreateLeaveRequest $request
     * @return mixed
     */
    public function store(CreateLeaveRequest $request)
    {
        return $this->leaveService->createByStudent($request);
    }

    /**
     * getYearsLearn function
     *
     * @param integer $classId
     * @return array
     */
    public function getYearsLearn(int $classId)
    {
        return $this->leaveService->getYearsLearnOfStudent($classId);
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
     * update function
     *
     * @param UpdateLeaveRequest $request
     * @param integer $leaveId
     * @return mixed
     */
    public function update(UpdateLeaveRequest $request, int $leaveId)
    {
        $request->merge(['id' => $leaveId]);
        return $this->leaveService->update($request);
    }

    /**
     * delete function
     *
     * @param integer $leaveId
     * @return mixed
     */
    public function delete(int $leaveId)
    {
        return $this->leaveService->delete($leaveId);
    }

    public function leavesSemester(Request $request)
    {
        return $this->leaveService->studentLeavesSemester($request);
    }

}
