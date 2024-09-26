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
     * @param $lessonId
     * @return mixed
     */
    public function checkStateLesson(Request $request)
    {
        $lessonId = $request->lessonId;
        return $this->lessonRepository
                    ->checkStateLesson($lessonId);
    }

    /**
     * turn on attendance function
     * @param Request $request
     * @return 
     */
    public function turnOnAttendance(Request $request)
    {
        $lessonId   = $request->lessonId;
        $radius     = $request->radius;
        $latitude   = $request->latitude;
        $longitude  = $request->longitude;

        $run = $this->lessonRepository
            ->turnOnAttendance ($lessonId, $radius, $latitude, $longitude);
        if($run)
            return $this->resSuccessOrFail(null, trans('text.attendance.turn_on_attendance'), Response::HTTP_UNAUTHORIZED);
    }

    /**
     * turn off attendance function
     * @param Request $request
     * @return 
     */
    public function turnOffAttendance(Request $request)
    {
        $lessonId = $request->lessonId;
        $run = $this->lessonRepository
                ->turnOffAttendance($lessonId);
        if($run)
            return $this->resSuccessOrFail(null, trans('text.attendance.turn_off_attendance'), Response::HTTP_UNAUTHORIZED);
    }
}
