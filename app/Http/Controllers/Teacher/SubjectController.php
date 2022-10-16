<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Services\SubjectService;
use Illuminate\Http\Request;

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
     * getSubjectsClasses function
     *
     * @param Request $request
     * @return mixed
     */
    public function getSubjectsClasses(Request $request)
    {
        return $this->subjectService->getSubjectsClasses($request);
    }

}
