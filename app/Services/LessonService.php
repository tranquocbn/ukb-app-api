<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\LessonRepository;
class LessonService extends BaseService
{
    protected LessonRepository $lessonRepository;
    /**
     * @param LessonRepository $lessonRepository
     */
    public function __construct(LessonRepository $lessonRepository)
    {
        $this->lessonRepository = $lessonRepository;
    }

    /**
     * check state attendance of lesson
     * @param Request $request
     * @return mixed
     */
    public function checkStateLesson(Request $request)
    {
        return $this->lessonRepository->checkStateLesson($request->lessonId);
    }

    /**
     * turn on attendance function
     * @param Request $request
     * @return 
     */
    public function turnOnAttendance(Request $request)
    {
        $data = $request->all();
        $run = $this->lessonRepository->turnOnAttendance($data);
            
        if($run)
            return $this->resSuccessOrFail(null, trans('text.attendance.turn_on_attendance'));
    }

    /**
     * turn off attendance function
     * @param Request $request
     * @return 
     */
    public function turnOffAttendance(Request $request)
    {
        $run = $this->lessonRepository->turnOffAttendance($request->lessonId);

        if($run)
            return $this->resSuccessOrFail(null, trans('text.attendance.turn_off_attendance'));
    }
}
