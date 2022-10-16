<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\LessonService;
class LessonController extends Controller
{
    private LessonService $lessonService;
    /**
     * @param LessonService $lessonService
     */
    public function __construct(LessonService $lessonService)
    {
        $this->lessonService = $lessonService;
    }

    /**
     * getDateLearn function
     *
     * @param Request $request
     * @param integer $scheduleId
     * @return mixed
     */
    public function getDateLearn(Request $request, int $scheduleId)
    {
        return $this->lessonService->getDateLearn($scheduleId);
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

    public function yearLearn(Request $request)
    {
        return $this->lessonService->yearLearn($request);
    }
}
