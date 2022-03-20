<?php

namespace App\Services;

use App\Repositories\ClassRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClassService extends BaseService
{
    protected ClassRepository $classRepository;
    /**
     * contractor
     *
     * @param ClassRepository $classRepository
     */
    public function __construct(
       ClassRepository $classRepository
    )
    {
        $this->classRepository = $classRepository;
    }

    public function teacherGetClasses(Request $request)
    {
        return $this->classRepository->teacherGetClasses($request->schedule_id);
    }
}

