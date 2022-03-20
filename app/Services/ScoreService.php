<?php

namespace App\Services;

use App\Repositories\ClassRepository;
use App\Repositories\LessonRepository;
use App\Repositories\NotifyRepository;
use App\Repositories\ScheduleRepository;
use App\Repositories\ScoreFeedbackRepository;
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
    protected NotifyRepository $notifyRepository;
    protected ScoreFeedbackRepository $scoreFeedbackRepository;


    /**
     * @param ScoreRepository $scoreRepository
     * @param SubjectRepository $subjectRepository
     * @param ClassRepository $classRepository
     * @param ScheduleRepository $scheduleRepository 
     * @param LessonRepository $lessonRepository
     * @param NotifyRepository $notifyRepository
     */
    public function __construct(
        ScoreRepository $scoreRepository,
        SubjectRepository $subjectRepository, 
        ClassRepository $classRepository,
        ScheduleRepository $scheduleRepository,
        LessonRepository $lessonRepository,
        NotifyRepository $notifyRepository,
        ScoreFeedbackRepository $scoreFeedbackRepository
    )
    {
        $this->scoreRepository = $scoreRepository;
        $this->subjectRepository = $subjectRepository;
        $this->classRepository = $classRepository;
        $this->scheduleRepository = $scheduleRepository;
        $this->lessonRepository = $lessonRepository;
        $this->notifyRepository = $notifyRepository;
        $this->scoreFeedbackRepository = $scoreFeedbackRepository;
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
     * @param Request $request
     * @return mixed
     */
    public function updateScore(Request $request)
    {
        $dateCurrent = $this->getDateCurrent();
        $studentId = $request->studentId;
        $scheduleId = $request->scheduleId;
        $credit = $request->credit;
        $countLesson = $this->lessonRepository->countLessonCurrent($scheduleId, $dateCurrent['date']);

        $score = [
            'test_one' => isset($request->test_one) ? $request->test_one : null,
            'test_two' => isset($request->test_two) ? $request->test_two : null,
            'diligent' => isset($request->diligent) ? $request->diligent : null,
            'exam_first' => isset($request->exam_first) ? $request->exam_first : null,
            'exam_second' => isset($request->exam_second) ? $request->exam_second : null
        ];
        
        $info = array_merge($score, [   
                                'studentId' => $studentId,
                                'scheduleId' => $scheduleId,
                                'count' => $countLesson, 
                                'credit' => $credit
                            ]);

        $run = $this->scoreRepository->updateScore($info)->toArray();

        $arr = [
            'user_id' => $studentId,
            'notifiable_id' => $run[0]['id'],
            'notifiable_type' => 'scores'
        ];

        $notify = $this->notifyRepository->updateOrCreateNotify($arr);

        return $this->resSuccessOrFail(['notify' => $notify], trans('text.score.update_successful'));
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

    /**
     * studentScoreFeedback function
     *
     * @param Request $request
     * @return mixed
     */
    public function studentScoreFeedback(Request $request)
    {
        $scoreId = $request->scoreId;
        $date = $this->getDateCurrent();
        $isEnable = $this->scoreRepository->isEnableFeedback($scoreId, $date['date'])->toArray();

        if(empty($isEnable)) {
            return $this->resSuccessOrFail(null, trans('text.score.error_feedback'), Response::HTTP_NO_CONTENT);
        }

        $run = $this->scoreFeedbackRepository->studentScoreFeedback($scoreId, $request->reason);
        $schedule = $this->scoreRepository->getScheduleByScoreId($scoreId)->toArray();

        $arr = [
            'user_id' => $schedule[0]['schedule']['user_id'],
            'notifiable_id' => $run['id'],
            'notifiable_type' => 'score_feedbacks'
        ];

        $notify = $this->notifyRepository->updateOrCreateNotify($arr);

        return $this->resSuccessOrFail(['notify'=>$notify], trans('text.score.feedback_successful'));
    }

    /**
     * teacherScoreFeedback function
     *
     * @param Request $request
     * @return mixed
     */
    public function teacherScoreFeedback(Request $request)
    {
        $scoreFeedbackId = $request->scoreFeedbackId;
        $run = $this->scoreFeedbackRepository->teacherScoreFeedback($scoreFeedbackId, $request->reasonFeedback);
        $student = $this->scoreFeedbackRepository->getStudentByScoreFeedbackId($scoreFeedbackId)->toArray();
        
        $arr = [
            'user_id' => $student[0]['score']['user_id'],
            'notifiable_id' => $run['id'],
            'notifiable_type' => 'score_feedbacks'
        ];
        $notify = $this->notifyRepository->updateOrCreateNotify($arr);

        return $this->resSuccessOrFail(['notify'=>$notify], trans('text.score.feedback_successful'));
    }
}
