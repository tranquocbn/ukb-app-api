<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\LeaveRepository;
use App\Repositories\ScheduleRepository;

class LeaveService extends BaseService
{
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

    public function studentCreate(Request $request)
    {
        return $this->leaveRepository->studentCreate($request->toArray());
    }

    public function checkDateLeaveEnable(Request $request)
    {
        $data = $request->merge(['date_diff' => $this->dateDiff($request->date_start, $request->date_selected)]);
        $leaves = $this->leaveRepository->checkDateLeaveEnable($data->toArray());
        if($leaves->count() === 0) {
            return $this->resSuccessOrFail(null, trans('text.leave.date_invalid'));
        }
        return $this->resSuccessOrFail($leaves->toArray(), trans('text.leave.date_uninvalid'));
    }

}
