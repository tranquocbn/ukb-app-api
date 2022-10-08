<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Services\SubjectService;
use App\Http\Controllers\Controller;


class SubjectController extends Controller
{
    protected SubjectService $subjectService;

    /**
     *
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
     * @return mix
     */
    public function getSubjects(Request $request)
    {
        return $this->subjectService->getSubjectStudent($request);
    }
}
