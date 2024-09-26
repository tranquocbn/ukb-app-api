<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\SubjectRepository;
use App\Repositories\ScheduleRepository;

class SubjectService extends BaseService
{
    protected SubjectRepository $subjectRepository;
    protected ScheduleRepository $scheduleRepository;

    /**
     * @param SubjectRepository $subjectRepository
     */
    public function __construct(
        SubjectRepository $subjectRepository,
        ScheduleRepository $scheduleRepository
    )
    {
        $this->subjectRepository = $subjectRepository;
        $this->scheduleRepository = $scheduleRepository;
    }

    /**
     * @param year_current, month_current
     *
     */
    public function semester($year_start, $year_current, $month_current)
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
     * get subjects in semester current
     * 
     * @param REquest $req
     * 
     * @return mixed
     */
    public function getSubjectsInSemesterCurrent(Request $req)
    {
        $semester = $this->semester((int)$req->year_start, (int)$req->year_current, (int)$req->month_current);
        $subjects = $this->subjectRepository->getSubjectsInSemesterCurrent($req->class_id, $semester);

        return $subjects;
    }

    /**
     * get subjects schedule student
     *
     * @param Request $request
     * @return void
     */
    public function getSubjectsScheduleStudent(Request $request)
    {
        $subjects = $this->subjectRepository->getSubjectsScheduleStudent($request->user()['userable_id'])->toArray();
        return $this->resSuccessOrFail($subjects);
    }

    public function getSubjectsSemesterStudent(Request $request)
    {
        
    }

    
}

