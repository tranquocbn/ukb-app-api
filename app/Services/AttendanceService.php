<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\AttendanceRepository;

class AttendanceService extends BaseService
{
    protected AttendanceRepository $attendanceRepository;

    /**
     * @param AttendanceRepository $attendanceRepository
     */
    public function __construct(AttendanceRepository $attendanceRepository)
    {
        $this->attendanceRepository = $attendanceRepository;
    }

    public function getInfoSchedule(Request $request)
    {
        $userId   = $request->id;
        $dt         = now('Asia/Ho_Chi_Minh');
        $date       = date_format($dt,"Y-m-d");
        $time       = date_format($dt,"H");

        if($time >= 8 && $time <= 11) {
            $session = 1;
        } elseif($time >= 13 && $time <= 16) {
            $session = 2;
        } else {
            $session = 1;
        }

        // $scheduleId = $this->attendanceRepository
        //                     ->checkSchedule($userCode, $date, $session);
                            
        $scheduleId = $this->attendanceRepository
                            ->checkSchedule($userId, '2022-02-12', 2);

        return ['userId'   => $userId,
                'scheduleId' => $scheduleId,
                'date'       => $date,
                'session'    => $session
                ];
    }

    public function getInfoLesson(Request $request)
    {
        $data       = $this->getInfoSchedule($request);

        if(!$data['scheduleId']) {
            return $this->resSuccessOrFail(null, trans('text.attendance.check_schedule'), Response::HTTP_UNAUTHORIZED);
        }
        
        return $this->attendanceRepository
                    ->getInfoLesson($data['userId'], 2, '2022-02-12');
    }

    public function checkStateAttendance(Request $request)
    {
        $data       = $this->getInfoSchedule($request);
        
        // $lessonId   = $this->attendanceRepository
        //                     ->getIdLesson($data['scheduleId'], $data['date']);
        
        $lessonId   = 4;

        $state      = $this->attendanceRepository
                          ->checkStateAttendance($lessonId);

        if ($state == 0) {
            $radius     = '15';
            $latitude   = '16D';
            $longitude  = '20B';

            $this->attendanceRepository
                ->turnOnAttendance ($lessonId, $radius, $latitude, $longitude);
                       
            $this->attendanceRepository
                ->insertListStudent($lessonId);
                
            return $this->resSuccessOrFail(null, trans('text.attendance.turn_on_attendance'), Response::HTTP_UNAUTHORIZED);
        } 

        return $this->attendanceRepository
                    ->getInfoLesson($data['userId'], 2, '2022-02-12');
    }
}
