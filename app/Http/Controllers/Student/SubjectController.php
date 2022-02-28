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

    public function getSubjectsInSemesterCurrent(Request $request)
    {
        return $this->subjectService->getSubjectsInSemesterCurrent($request);
    }

}
