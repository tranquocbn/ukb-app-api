<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Services\SubjectService;
use App\Http\Controllers\Controller;


class SubjectController extends Controller
{
    private SubjectService $subjectService;

    /**
     * @param SubjectService $subjectService
     */
    public function __construct(SubjectService $subjectService)
    {
        $this->subjectService = $subjectService;
    }

    /**
     * get subjects in semester current
     *
     * @param Request $request
     * @return mixed
     */
    public function getSubjects(Request $request)
    {
        return $this->subjectService->getSubjectsByStudent($request);
    }
}
