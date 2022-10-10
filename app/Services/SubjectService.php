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
     * @param int $year_start
     * @param int $year_current
     * @param int $month_current
     * @return mixed
     */
    public function semester(int $yearStart, int $yearCurrent, int $monthCurrent)
    {           
        if ($yearCurrent === $yearStart) {
            return 1;
        }

        if ($monthCurrent >= 1 && $monthCurrent < 6) {
            return ($yearCurrent - $yearStart) * 2;
        }

        if ($monthCurrent >= 6 && $monthCurrent <= 12) {
            return ($yearCurrent - $yearStart) * 2 + 1;
        }
    }


    /**
     * get subjects in semester current of student function
     *
     * @param Request $request
     * @return mixed
     */
    public function getSubjectStudent(Request $request)
    {
        $classId = $request->user()->class_id;
        $academic = $this->academicRepository->getYearStart($classId);
        $semester = $this->semester($academic[0], date('Y'), date('m'));
        return $this->subjectRepository
        ->getSubjectsStudent('class_id', $classId, $semester);
    }
}

