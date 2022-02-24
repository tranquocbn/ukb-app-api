<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\LessonService;
class LessonController extends Controller
{
    private LessonService $lessonService;
    /**
     * LessonController Constructor
     * @param LessonService $lessonService
     */
    public function __construct(LessonService $lessonService)
    {
        $this->lessonService = $lessonService;
    }

    /**
     * checkStateLesson function
     * @param Request $request
     * @return mixed
     */
    public function checkStateLesson(Request $request)
    {
        return $this->lessonService
                    ->checkStateLesson($request);
    }

    /**
     * turnOnAttendance function
     * @param Request $request
     * @return mixed
     */
    public function turnOnAttendance(Request $request)
    {
        return $this->lessonService
                ->turnOnAttendance($request);
    }

    /**
     * turnOffAttendance function
     * @param Request $request
     * @return mixed
     */
    public function turnOffAttendance(Request $request)
    {
        return $this->lessonService
                ->turnOffAttendance($request);
    }
}
