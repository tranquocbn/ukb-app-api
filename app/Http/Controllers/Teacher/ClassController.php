<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use App\Services\ClassService;
use Illuminate\Http\Request;

class ClassController extends Controller
{

    /**
     * constructor
     *
     * @param ClassService $classService
     */
    public function __construct(ClassService $classService)
    {
        $this->classService = $classService;
    }

    public function getClasses(Request $request)
    {
        return $this->classService->teacherGetClasses($request);
    }
}
