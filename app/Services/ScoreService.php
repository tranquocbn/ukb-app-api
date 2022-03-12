<?php

namespace App\Services;

use App\Repositories\ClassRepository;
use App\Repositories\LessonRepository;
use App\Repositories\ScheduleRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\ScoreRepository;
use App\Repositories\SubjectRepository;

class ScoreService extends BaseService
{
    protected ScoreRepository $scoreRepository;
    protected SubjectRepository $subjectRepository;
    protected ClassRepository $classRepository;
    protected ScheduleRepository $scheduleRepository;
    protected LessonRepository $lessonRepository;

    /**
     * @param ScoreRepository $scoreRepository
     * @param SubjectRepository $subjectRepository
     * @param ClassRepository $classRepository
     * @param ScheduleRepository $scheduleRepository 
     * @param LessonRepository $lessonRepository
     */
    public function __construct(
        ScoreRepository $scoreRepository,
        SubjectRepository $subjectRepository, 
        ClassRepository $classRepository,
        ScheduleRepository $scheduleRepository,
        LessonRepository $lessonRepository
    )
    {
        $this->scoreRepository = $scoreRepository;
        $this->subjectRepository = $subjectRepository;
        $this->classRepository = $classRepository;
        $this->scheduleRepository = $scheduleRepository;
        $this->lessonRepository = $lessonRepository;
    }

    public function getScores(Request $request, $scheduleId)
    {
        $scores = $this->scoreRepository->getScores($request, $scheduleId)->toArray();
        return $this->resSuccessOrFail($scores, 'list score');
    }

    /**
     * teacherGetScores
     *
     * @param Request $request
     * @return void
     */
    public function teacherGetScores(Request $request)
    {
        $classId = $request->class_id;
        $scheduleId = $request->schedule_id;
        return $this->scoreRepository->teacherGetScores($scheduleId, $classId);
    }


    /**
     * getScoreByStudentId function
     *
     * @param Request $request
     * @return mixed
     */
    public function getScoreByStudentId(Request $request)
    {
        return $this->scoreRepository->getScoreByStudentId($request->student_id, $request->schedule_id);
    }

    /**
     * updateScore function
     *
     * @param [type] $request
     * @return mixed
     */
    public function updateScore($request)
    {
        $dateCurrent = $this->getDateCurrent();

        $studentId = $request->studentId;
        $scheduleId = $request->scheduleId;
        $subjectId = $request->subjectId;
        $credit = $request->credit;
        $diligent = $test_one = $test_two = $exam_first = $exam_second = null;
        $countLesson = $this->lessonRepository->countLessonCurrent($scheduleId, $dateCurrent['date']);

        if(($credit == 2 && $countLesson >= 3) || ($credit == 3 && $countLesson >= 4)) {
            $test_one = $request->test_one;
        }

        if(($credit == 2 && $countLesson >= 6) || ($credit == 3 && $countLesson >= 10)) {
            $test_one = $request->test_one;
            $test_two = $request->test_two;
        }

        if(($credit == 2 && $countLesson >= 8) || ($credit == 3 && $countLesson >= 11)) {
            $diligent = $request->diligent;
            $test_one = $request->test_one;
            $test_two = $request->test_two;
            $exam_first = $request->exam_first;
            $exam_second = $request->exam_second;
        }

        $data = compact('scheduleId', 'studentId', 'diligent', 'test_one', 
                        'test_two', 'exam_first', 'exam_second');
        $this->scoreRepository->updateScore($data);

        return $this->resSuccessOrFail(null, trans('text.score.update_successful'));
    }

    /**
     * studentGetScore function
     *
     * @param Request $request
     * @return mixed
     */
    public function studentGetScore(Request $request)
    {
        return $this->scoreRepository->studentGetScore($request->user()->id, $request->schedule_id);
    }
}
