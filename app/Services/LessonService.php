<?php

namespace App\Services;

use App\Repositories\LeaveRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\LessonRepository;
use App\Repositories\ScheduleRepository;
use App\Traits\DateCalculateTrait;
class LessonService extends BaseService
{
    use DateCalculateTrait;
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
     * get date learn function
     *
     * @param integer $scheduleId
     * @return mixed
     */
    public function getDateLearn(int $scheduleId)
    {
        return $this->lessonRepository->getDateLearn($scheduleId);
    }

    /**
     * getInfoLessonTeacher function
     * @param Request $request
     * @return mixed
     */
    public function getInfoLessonTeacher(Request $request)
    {
        $userId = $request->user()->id;
        $data = $this->getDateCurrent();
        $date = $data['date'];
        $lesson = $this->lessonRepository->checkSchedule('user_id', $userId, $date, $data['session'])->toArray();
        
        if(empty($lesson))
            return $this->resSuccessOrFail(null, trans('text.attendance.check_schedule'), Response::HTTP_NOT_FOUND);

        $info = $this->lessonRepository->getInfoLesson($lesson[0]['id'])->toArray();
        $count = $this->lessonRepository->countLessonCurrent($lesson[0]['schedule_id'], $date);
        $info = array_merge($info[0], ['count_lesson' => $count]);
        
        return $info;
    }

    /**
     * student getInfoLesson function
     * @param Request $request
     * @return mixed
     */
    public function getInfoLessonStudent(Request $request)
    {
        $data = $this->getDateCurrent();
        $date = $data['date'];
        $classId = $request->user()->userable_id;

        $lesson = $this->lessonRepository->checkSchedule('class_id', $classId, $date, $data['session'])->toArray();
        
        if(empty($lesson)) {
            return $this->resSuccessOrFail(null, trans('text.attendance.check_schedule'), Response::HTTP_NOT_FOUND);
        }
        $info = $this->lessonRepository->getInfoLesson($lesson[0]['id'])->toArray();
        $count = $this->lessonRepository->countLessonCurrent($lesson[0]['schedule_id'], $date);
        $info = array_merge($info[0], ['count_lesson' => $count]);
        
        return $info;
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
