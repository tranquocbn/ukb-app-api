<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Http\Requests\Student\CreateLeaveRequest;
use Illuminate\Http\Response;
use App\Repositories\LeaveRepository;
use App\Repositories\ScheduleRepository;
use App\Repositories\NotifyRepository;
use App\Traits\DateCalculateTrait;

class LeaveService extends BaseService
{
    use DateCalculateTrait;
    private ScheduleRepository $scheduleRepository;
    private LeaveRepository $leaveRepository;
    private NotifyRepository $notifyRepository;

    /**
     * Undocumented function
     *
     * @param ScheduleRepository $scheduleRepository
     * @param LeaveRepository $leaveRepository
     * @param NotifyRepository $notifyRepository
     */
    public function __construct(
        ScheduleRepository $scheduleRepository,
        LeaveRepository $leaveRepository,
        NotifyRepository $notifyRepository
    )
    {
        $this->scheduleRepository = $scheduleRepository;
        $this->leaveRepository = $leaveRepository;
        $this->notifyRepository = $notifyRepository;
    }

    public function notifyCreateLeave($scheduleId, $id)
    {
        $teacher = $this->scheduleRepository->getTeacher($scheduleId);
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
     * @param CreateLeaveRequest $request
     * @return mix
     */
    public function studentStore(CreateLeaveRequest $request)
    {
        if($this->leaveRepository->countLeaveStuent($request->schedule_id, $request->user()->id)>=2) {
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
        $create = $this->leaveRepository->studentCreate($request->toArray());

        if($create) {
            $request->merge(['notifiable_id'=> $create['id']]);
            $this->notifyCreateLeave($request['schedule_id'], $create['id']);
        }
        return $this->resSuccessOrFail($create->toArray(), trans('text.leave.successfully'), Response::HTTP_CREATED);
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
