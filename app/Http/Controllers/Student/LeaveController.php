<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Services\LeaveService;
use App\Services\SubjectService;

class LeaveController extends Controller
{
    private LeaveService $leaveService;
    private SubjectService $subjectService;

    /**
     * UserController Constructor
     * @param LeaveService $LeaveService
     */
    public function __construct(
        LeaveService $leaveService,
        SubjectService $subjectService
        )
    {
        $this->leaveService = $leaveService;
        $this->subjectService = $subjectService;
    }

    /**
     * get subjects in semester
     * 
     * 
     * @return mixed
     */
    public function getSubjectsInSemesterCurrent(Request $request)
    {
        return $this->subjectService->getSubjectsInSemesterCurrent($request);
    }


}
