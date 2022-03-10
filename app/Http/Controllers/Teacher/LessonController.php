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
     * getInfoLesson function
     * @param Request $request
     * @return mixed
     */
    public function getInfoLesson(Request $request)
    {
        return $this->lessonService->teacherGetInfoLesson($request);
    }

    public function checkStateLesson($lessonId)
    {
        return $this->lessonService->checkStateLesson($lessonId);
    }
}
