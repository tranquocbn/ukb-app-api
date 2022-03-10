<?php

namespace App\Services;

use App\Repositories\AttendanceRepository;
use App\Repositories\LeaveRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\ScheduleRepository;
use App\Repositories\UserRepository;

class ScheduleService extends BaseService
{
    protected UserRepository $userRepository;
    protected ScheduleRepository $scheduleRepository;
    protected AttendanceRepository $attendanceRepository;
    /**
     * @param UserRepository $userRepository
     * @param ScheduleRepository $scheduleRepository
     * @param LeaveRepository $leaveRepository
     * @param AttendanceRepository $attendanceRepository
     */
    public function __construct(
        ScheduleRepository $scheduleRepository
    )
    {
        $this->scheduleRepository = $scheduleRepository;
    }
}

