<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use App\Services\SubjectService;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    protected SubjectService $subjectService;

    /**
     * constructor 
     * @param SubjectService $subjectService
     */

    public function __construct(SubjectService $subjectService)
    {
        $this->subjectService = $subjectService;
    }

    public function getSubjects(Request $request)
    {
        return $this->subjectService->teacherGetSubjects($request);
    }

}
