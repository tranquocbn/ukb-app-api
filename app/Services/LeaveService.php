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
        $data = $request->merge(['date_diff' => $this->dateDiff($request->date_start, $request->date_selected)])->toArray();
        $leaves = $this->leaveRepository->checkDateLeaveEnable($data);
        if($leaves->count() === 0) {
            return $this->resSuccessOrFail(null, trans('text.leave.date_invalid'));
            // dd('nhap dung');
            // return;
        }
        return $this->resSuccessOrFail($leaves, trans('text.leave.date_uninvalid', Response::HTTP_NO_CONTENT));
        // dd('sai ngay');
    }

    // public function checkDateLeaveEnable(Request $request)
    // {
    //     $isExistDateChange = $this->checkExistInDateChange($request->date_selected, $request->schedule_id, $request->teacher_id);
    //     $leaves = $this->leaveRepository->checkDateLeaveEnable($request->all());
    //     if($isExistDateChange || $leaves->count() !== 0) {
    //         return $this->resSuccessOrFail(null, trans('text.leave.date_invalid'));
    //     } 
    //     return $this->resSuccessOrFail(null, null, Response::HTTP_NO_CONTENT);
    // }

    // public function checkExistInDateChange($dateSelected, $scheduleId, $teacherId)
    // {
    //     $dateChanges = $this->leaveRepository->getDateChanges($scheduleId, $teacherId);
    //     if($dateChanges) {
    //         $dateChanges = $dateChanges->toArray();
    //     }
    //     return in_array($dateSelected, $dateChanges);
    // }
    
}
