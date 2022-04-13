<?php

namespace App\Services;

use App\Repositories\AttendanceRepository;
use App\Repositories\LeaveRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\ScheduleRepository;
use App\Repositories\UserRepository;
use App\Traits\DateCalculateTrait; 
class ScheduleService extends BaseService
{
    use DateCalculateTrait;
    protected UserRepository $userRepository;
    protected ScheduleRepository $scheduleRepository;

    /**
     * @param UserRepository $userRepository
     * @param ScheduleRepository $scheduleRepository
     */
    public function __construct(
        ScheduleRepository $scheduleRepository, 
        UserRepository $userRepository
    )
    {
        $this->scheduleRepository = $scheduleRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * getSemesters function
     *
     * @param Request $request
     * @return mixed
     */
    public function getSemesters(Request $request)
    {
        $dateCurrent = $this->getDateCurrent();
        $data = [
            'classId' => $request->user()->userable_id,
            'date' => $dateCurrent['date']
        ];
        
        return $this->scheduleRepository->getSemesters($data);
    }

    public function yearLearn(Request $request)
    {
        return $this->scheduleRepository->yearLearn($request->user()->id);
    }

}

