<?php
namespace App\Http\Controllers\Student;

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
     * getInfoLesson function
     *
     * @param Request $request
     * @return mixed
     */
    public function getInfoLesson(Request $request)
    {
        return $this->lessonService->getInfoLessonStudent($request);
    }

    
    /**
     * getDateLearn function
     *
     * @param integer $scheduleId
     * @return mixed
     */
    public function getDateLearn(int $scheduleId)
    {
        return $this->lessonService->getDateLearn($scheduleId);
    }
}
