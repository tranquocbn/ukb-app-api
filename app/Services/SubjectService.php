<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\SubjectRepository;
use App\Repositories\ScheduleRepository;
use App\Repositories\AcademicRepository;
use App\Traits\DateCalculateTrait;

class SubjectService extends BaseService
{
    use DateCalculateTrait;
    private SubjectRepository $subjectRepository;
    private ScheduleRepository $scheduleRepository;
    private AcademicRepository $academicRepository;

    /**
     *
     * @param SubjectRepository $subjectRepository
     * @param ScheduleRepository $scheduleRepository
     * @param AcademicRepository $academicRepository
     */
    public function __construct(
        SubjectRepository $subjectRepository,
        ScheduleRepository $scheduleRepository,
        AcademicRepository $academicRepository,
    )
    {
        $this->subjectRepository = $subjectRepository;
        $this->scheduleRepository = $scheduleRepository;
        $this->academicRepository = $academicRepository;
    }

    /**
     * Undocumented function
     *
     * @param int $year_start
     * @param int $year_current
     * @param int $month_current
     * @return mixed
     */
    public function semester(int $year_start, int $year_current, int $month_current)
    {           
        if ($year_current === $year_start) {
            return 1;
        }

        if ($month_current >= 1 && $month_current < 6) {
            return ($year_current - $year_start) * 2;
        }

        if ($month_current >= 6 && $month_current <= 12) {
            return ($year_current - $year_start) * 2 + 1;
        }
    }


    /**
     * get subjects in semester current of student function
     *
     * @param Request $request
     * @return void
     */
    public function getSubjectsStudent(Request $request)
    {
        $class_id = $request->user()->class_id;
        $academic = $this->academicRepository->getYearStart($class_id);
        $semester = $this->semester($academic['year_start'], date('Y'), date('m'));
        return $this->subjectRepository
        ->getSubjectsInSemesterCurrent('class_id', $class_id, $semester);
    }

    /**
     * get subjects schedule student
     *
     * @param Request $request
     * @return void
     */
    public function getSubjectsScheduleStudent(Request $request)
    {
        // $subjects = $this->subjectRepository->getSubjectsScheduleStudent($request->user()['userable_id'])->toArray();
        // return $this->resSuccessOrFail($subjects);
    }

    public function getSubjectsSemesterStudent(Request $request)
    {
        
    }

    /**
     * teacherGetSubjects
     *
     * @param Request $request
     * @return mixed
     */
    public function teacherGetSubjects(Request $request)
    {
        $user_id = $request->user()->id;
        $dateCurrent = $this->getDateCurrent();
        $month = $dateCurrent ['month'];

        //0: kì chẵn, 1: kì lẻ
        $semester = ($month >= 1 && $month <= 6) ? 0 : 1;

        $data = array_merge($dateCurrent, ['user_id' => $user_id], ['semester' => $semester]);
        return $this->subjectRepository->teacherGetSubjects($data);
    }
}

