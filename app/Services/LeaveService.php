<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\LeaveRepository;
use App\Repositories\ScheduleRepository;
use App\Traits\DateCalculateTrait;

class LeaveService extends BaseService
{
    use DateCalculateTrait;
    protected ScheduleRepository $scheduleRepository;
    protected LeaveRepository $leaveRepository;

    /**
     * @param ScheduleRepository $scheduleRepository
     * @param LeaveRepository $leaveRepository
     */
    public function __construct(
        ScheduleRepository $scheduleRepository,
        LeaveRepository $leaveRepository
    )
    {
        $this->scheduleRepository = $scheduleRepository;
        $this->leaveRepository = $leaveRepository;
    }

    /**
     * student create leave
     *
     * @param Request $request
     * @return mix
     */
    public function studentStore(Request $request)
    {
        return $this->leaveRepository->studentCreate($request->toArray());
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
