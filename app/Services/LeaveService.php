<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Http\Requests\Student\CreateLeaveRequest as StudentCreateLeaveRequest;
use App\Http\Requests\UpdateLeaveRequest;
use App\Http\Requests\Teacher\CreateLeaveRequest as TeacherCreateLeaveRequest;
use App\Http\Requests\Teacher\FeedbackLeaveRequest;
use App\Repositories\AcademicRepository;
use Illuminate\Http\Response;
use App\Repositories\LeaveRepository;
use App\Repositories\ScheduleRepository;
use App\Repositories\NotifyRepository;
use App\Traits\DateCalculateTrait;
use CreateUsersTable;

class LeaveService extends BaseService
{
    use DateCalculateTrait;
    private ScheduleRepository $scheduleRepository;
    private LeaveRepository $leaveRepository;
    private NotifyRepository $notifyRepository;
    private AcademicRepository $academicRepository;

    /**
     *
     * @param ScheduleRepository $scheduleRepository
     * @param LeaveRepository $leaveRepository
     * @param NotifyRepository $notifyRepository
     * @param AcademicRepository $academicRepository
     * 
     */
    public function __construct(
        ScheduleRepository $scheduleRepository,
        LeaveRepository $leaveRepository,
        NotifyRepository $notifyRepository, 
        AcademicRepository $academicRepository,
    )
    {
        $this->scheduleRepository = $scheduleRepository;
        $this->leaveRepository = $leaveRepository;
        $this->notifyRepository = $notifyRepository;
        $this->academicRepository = $academicRepository;
    }

    /**
     * notify student create leave function
     *
     * @param integer $scheduleId
     * @param integer $id
     * @return mixed
     */
    public function notifyStudentCreateLeave(int $scheduleId, int $id)
    {
        $teacher = $this->scheduleRepository->getTeacherByScheduleId($scheduleId);
        $data = [
            'user_id' => $teacher['user_id'],
            'notifiable_id' => $id,
            'notifiable_type' => 'leaves'
        ];
        
        return $this->notifyRepository->updateOrCreate($data);
    }

    /**
     * student create leave
     *
     * @param StudentCreateLeaveRequest $request
     * @return mixed
     */
    public function createStudent(StudentCreateLeaveRequest $request)
    {
        if($this->leaveRepository->countLeaveStudent($request->schedule_id, $request->user()->id) >= MAX_LEAVE) {
            return $this->resSuccessOrFail(null, trans('text.leave.limited'));
        }
        
        $dataDate = $this->getDateCurrent();

        if($dataDate['date'] == $request->date_want) {
            if(AM_START - $dataDate['hour'] < 1 || PM_START - $dataDate['hour'] < 1) {
                return $this->resSuccessOrFail(null, trans('text.leave.overtime'), Response::HTTP_UNPROCESSABLE_ENTITY);
            }
        }

        $request->merge([
            'user_id' => $request->user()->id,
            'date_application' => $dataDate['date']
        ]);
        $create = $this->leaveRepository->create($request->toArray());

        if($create) {
            $request->merge(['notifiable_id'=> $create['id']]);
            $this->notifyStudentCreateLeave($request->schedule_id, $create['id']);
        }
        return $this->resSuccessOrFail($create->toArray(), trans('text.leave.successfully'), Response::HTTP_CREATED);
    }

    /**
     * getYearsLearnOfStudent function
     *
     * @param integer $classId
     * @return array
     */
    public function getYearsLearnOfStudent(int $classId)
    {
        $academic = $this->academicRepository->getYearStart($classId);
        $year = [];
        for ($i= (int) date('Y'); $i >= $academic[0]; $i--) { 
            array_push($year, $i);
        }
        return $year;
    }

    /**
     * get list leaves by student or teacher function
     *
     * @param Request $request
     * @return mixed
     */
    public function getLeaves(Request $request)
    {
        if ($request->user()->role == STUDENT) {
            return $this->leaveRepository->getLeavesStudent($request->user()->id, $request->year_learn, $request->semester);
        }

        if ($request->user()->role == TEARCHER) {
            return $this->leaveRepository->getLeavesTeacher($request->user()->id, $request->year_learn, $request->semester);
        }
    }
    
    /**
     * update leaves function
     *
     * @param Request $request
     * @return mixed
     */
    public function update(UpdateLeaveRequest $request)
    {
        $leave = $this->leaveRepository->getLeaveById($request['id']);
        if($leave[0]['status'] === STATUS_APPROVED) {
            return $this->resSuccessOrFail(null, trans('text.leave.update.fail'));
        }

        if ($this->leaveRepository->update($request)) {
            return $this->resSuccessOrFail(null, trans('text.leave.update.successfully'));
        }
    }

    /**
     * delete function
     *
     * @param integer $leaveId
     * @return mixed
     */
    public function delete(int $leaveId)
    {
        $leave = $this->leaveRepository->getLeaveById($leaveId);
        if(date('Y-m-d') <= $leave[0]['date_want']) {
            return $this->resSuccessOrFail(null, trans('text.leave.delete.fail'));
        }

        if($this->leaveRepository->delete($leaveId)) {
            return $this->resSuccessOrFail(null, trans('text.leave.delete.successfully'));
        }
    }

    public function feedback(FeedbackLeaveRequest $request)
    {
        $request->merge(['status' => STATUS_APPROVED]);

        if($request->has('_method')) {
            unset($request['_method']);
        }

        if($request->has('options')) {
            unset($request['options']);
        }
        
        if($this->leaveRepository->feedback($request)) {
            return $this->resSuccessOrFail(null, trans('text.leave.feedback.successfully'));
        }
    }
    /**
     * createTeacher function
     *
     * @param TeacherCreateLeaveRequest $request
     * @return mixed
     */
    public function createTeacher(TeacherCreateLeaveRequest $request)
    {
        $request->merge([
            'user_id' => $request->user()->id,
            'date_application' => date('Y-m-d')
        ]);
        
        $create = $this->leaveRepository->create($request->toArray());

        return $this->resSuccessOrFail($create->toArray(), trans('text.leave.successfully'), Response::HTTP_CREATED);
    }

    /**
     * get teacher's 5 learn years nearest function
     *
     * @return array
     */
    public function getYears()
    {
        $yearCurrent = (int) date("Y");
        $years = [];
        for ($i = $yearCurrent; $i >= $yearCurrent - 4; $i--) { 
            array_push($years, $i);
        }
        return $years;
    }

    /**
     * check date selected by student create leave
     *
     * @param Request $request
     * @return mix
     */
    public function checkDateLeaveEnable(Request $request)
    {
        $data = $request->merge(['date_diff' => $this->dateDiff($request->date_start, $request->date_selected)]);
        $leaves = $this->leaveRepository->checkDateLeaveEnable($data->toArray());
        if($leaves->count() === 0) {
            return $this->resSuccessOrFail(null, trans('text.leave.date_invalid'));
        }
        return $this->resSuccessOrFail($leaves->toArray(), trans('text.leave.date_uninvalid'));
    }

    public function studentLeavesSemester(Request $request)
    {
        $data = [
            'user_id' => $request->user()['id'],
            'schedule_id' => $request->schedule_id
        ];
        $leaves = $this->leaveRepository->studentLeavesSemester($data)->toArray();
        return $this->resSuccessOrFail($leaves);
    }

}
