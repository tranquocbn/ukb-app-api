<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Requests\Teacher\CreateLeaveRequest;
use App\Services\LeaveService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\FeedbackLeaveRequest;
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
     * create leave function
     * @param CreateLeaveRequest $request
     * @return mixed
     */
    public function store(CreateLeaveRequest $request)
    {
        return $this->leaveService->createByTeacher($request);
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
    
    /**
     * feedback function
     *
     * @param FeedbackLeaveRequest $request
     * @param integer $leaveId
     * @return mixed
     */
    public function feedback(FeedbackLeaveRequest $request, int $leaveId)
    {
        $request->merge(['id' => $leaveId]);
        return $this->leaveService->feedback($request);
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
