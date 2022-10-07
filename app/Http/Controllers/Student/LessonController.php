<?php
namespace App\Http\Controllers\Student;

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
     * Undocumented function
     *
     * @param Request $request
     * @return mixed
     */
    public function getInfoLesson(Request $request)
    {
        return $this->lessonService->studentGetInfoLesson($request);
    }

    
    /**
     * get date learn > date current function
     *
     * @param $schedule_id
     * @return mixed
     */
    public function getDateLearn($schedule_id)
    {
        return $this->lessonService->getDateLearn($schedule_id);
    }
}
