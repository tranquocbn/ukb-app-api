<?php

namespace App\Services;

use App\Repositories\LeaveRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\LessonRepository;
use App\Repositories\ScheduleRepository;
class LessonService extends BaseService
{
    protected LessonRepository $lessonRepository;
    protected LeaveRepository $leaveRepository;
    protected ScheduleRepository $scheduleRepository;
    /**
     * @param LessonRepository $lessonRepository
     * @param LeaveRepository $leaveRepository
     * @param ScheduleRepository $scheduleRepository
     */
    public function __construct(
        LessonRepository $lessonRepository,
        LeaveRepository $leaveRepository,
        ScheduleRepository $scheduleRepository
    )
    {
        $this->lessonRepository = $lessonRepository;
        $this->leaveRepository = $leaveRepository;
        $this->scheduleRepository = $scheduleRepository;
    }

    /**
     * checkStateLesson function
     * @param $lessonId
     * @return mixed
     */
    public function checkStateLesson($lessonId)
    {
        return $this->lessonRepository->checkStateLesson($lessonId);
    }

    /**
     * getTime function
     * @return array
     */
    public function getTime()
    {
        $dt = now('Asia/Ho_Chi_Minh');
        $date = date_format($dt,"Y-m-d");
        $time = date_format($dt,"H");
        $year = date_format($dt,"Y");
        $session = 0;

        if($time >= 8 && $time <= 12) {
            $session = 1;
        } 
        if($time >= 13 && $time <= 16) {
            $session = 2;
        }
        return [
            'date' => $date,
            'session' => $session,
            'year' => $year
        ];
    }
    /**
     * teacherGetInfoLesson function
     * @param Request $request
     * @return mixed
     */
    public function teacherGetInfoLesson(Request $request)
    {
        $userId = $request->user()->id;
        $data = $this->getTime();
        $date = $data['date']; 

        $dateWant = $this->leaveRepository->getDateWant($userId, $date)->toArray();

        if(!$dateWant) {
            $schedule = $this->scheduleRepository->checkSchedule('user_id', $userId, $date, $data['session'], $data['year'])->toArray();
            
            if(!$schedule) {
                return $this->resSuccessOrFail(null, trans('text.attendance.check_schedule'), Response::HTTP_NOT_FOUND);
            }

            $scheduleId = $schedule[0]['id'];
            $lessons = $this->lessonRepository->getInfoLesson($scheduleId)->toArray();

            foreach ($lessons as $lesson){
                if($lesson['date_learn'] === $date){
                    return array_merge($lesson, ['count' => count($lessons)]);
                };
            }
        }
        return $this->resSuccessOrFail(null, trans('text.attendance.check_schedule'), Response::HTTP_NOT_FOUND);
    }

    /**
     * student getInfoLesson function
     * @param Request $request
     * @return mixed
     */
    public function studentGetInfoLesson(Request $request)
    {
        $data = $this->getTime();
        $date = $data['date'];
        $classId = $request->user()->userable_id;

        $isLeave = $this->scheduleRepository->isLeave($classId, $date)->toArray();
        if(!$isLeave) {
            $schedule = $this->scheduleRepository->checkSchedule('class_id', $classId, $date, $data['session'], $data['year'])->toArray();
            
            if(!$schedule) {
                return $this->resSuccessOrFail(null, trans('text.attendance.check_schedule'), Response::HTTP_NOT_FOUND);
            }

            $scheduleId = $schedule[0]['id'];
            $lessons = $this->lessonRepository->getInfoLesson($scheduleId)->toArray();

            foreach ($lessons as $lesson){
                if($lesson['date_learn'] === $date){
                    return array_merge($lesson, ['count' => count($lessons)]);
                };
            }
        }
        return $this->resSuccessOrFail(null, trans('text.attendance.check_schedule'), Response::HTTP_NOT_FOUND);
    }

    public function yearLearn(Request $request)
    {
        $dt = now('Asia/Ho_Chi_Minh');
        $data = [
            'year' => date_format($dt,"Y"),
            'user_id' => $request->user()->id
        ];
        return $this->lessonRepository->yearLearn($data);
    }
}
