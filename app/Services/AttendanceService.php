<?php

namespace App\Services;

use App\Repositories\AttendanceRepository;

class AttendanceService
{
    /**
     * @var $attendanceRepository
     */
    protected AttendanceRepository $attendanceRepository;

    /**
     * AttendanceService Constructor
     * @param AttendanceRepository $attendanceRepository
     */
    public function __construct(AttendanceRepository $attendanceRepository)
    {
        $this->attendanceRepository = $attendanceRepository;
    }

    public function getInfoLesson($user_code, $class_code)
    {
        $check = $this->userRepository->checkSchedule($user_code, $class_code);
        if(!$check) {
            return 'Hôm nay bạn không có tiết dạy';
        } else {
            $info = $this->userRepository->getInfoLesson($user_code, $class_code);
            return $info;
        }
    }
}