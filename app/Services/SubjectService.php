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
     * semester function
     *
     * @param integer $yearStart
     * @param integer $yearCurrent
     * @param integer $monthCurrent
     * @return integer
     */
    public function semester(int $yearStart, int $yearCurrent, int $monthCurrent)
    {           
        if ($yearCurrent === $yearStart) {
            return 1;
        }

        if ($monthCurrent >= START_SEMESTER_1 && $monthCurrent <= END_SEMESTER_1) {
            return ($yearCurrent - $yearStart) * 2 + 1;
        }

        if ($monthCurrent >= START_SEMESTER_2 && $monthCurrent < END_SEMESTER_2) {
            return ($yearCurrent - $yearStart) * 2;
        }
    }


    /**
     * get subjects in semester current of student function
     *
     * @param Request $request
     * @return mixed
     */
    public function getSubjectsByStudent(Request $request)
    {
        $classId = $request->user()->class_id;
        $academic = $this->academicRepository->getYearStart($classId);
        $semester = $this->semester($academic[0], date('Y'), date('m'));
        return $this->subjectRepository
        ->getSubjectsByStudent($classId, $semester);
    }

    /**
     * get Subjects and Classes current by teacher function
     *
     * @param Request $request
     * @return mixed
     */
    public function getSubjectsClasses(Request $request)
    {
        $userId = $request->user()->id;
        if (date('m') >= START_SEMESTER_1 && date('m') < END_SEMESTER_1) {
            $monthStart = 6;
        }

        if (date('m') >= START_SEMESTER_2 && date('m') <= END_SEMESTER_2) {
            $monthStart = 1;
        }

        return $this->subjectRepository->getSubjectsClasses($userId, $monthStart);
    }
}

