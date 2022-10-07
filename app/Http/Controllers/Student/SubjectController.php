<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Services\SubjectService;
use App\Http\Controllers\Controller;


class SubjectController extends Controller
{
    protected SubjectService $subjectService;

    public function __construct(SubjectService $subjectService)
    {
        $this->subjectService = $subjectService;
    }

    /**
     * get subjects in semester current
     *
     * @param Request $request
     * @return mix
     */
    public function getSubjectsInSemesterCurrent(Request $request)
    {
        return $this->subjectService->getSubjectsStudent($request);
    }

    /**
     * get subjects schedule
     *
     * @param Request $request
     * @return mix
     */
    public function getSubjectsSchedule(Request $request)
    {
        return $this->subjectService->getSubjectsScheduleStudent($request);
    }

    public function getSubjectsSemester(Request $request)
    {
        return 'ok';
    }

}
