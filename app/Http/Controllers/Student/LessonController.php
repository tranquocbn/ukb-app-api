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
    
    public function getInfoLesson(Request $request)
    {
        return $this->lessonService->studentGetInfoLesson($request);
    }
}
