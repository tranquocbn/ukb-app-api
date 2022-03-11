<?php

namespace App\Services;
use Illuminate\Http\Response;

class BaseService
{
    protected function resSuccessOrFail(array $data = null, string $msg = null, int $status = Response::HTTP_OK)
    {
        $dataRes = ['status' => $status];

        if($msg !== null) {
            $dataRes['message'] = $msg;
        }

        if($data !== null) {
            $dataRes['data'] = $data;
        }
        return response()->json($dataRes, $status);
    }

    protected function dateDiff($dateStart, $dateSecond)
    {
        $datediff = abs(strtotime($dateStart) - strtotime($dateSecond));
        return floor($datediff / (60*60*24));
    }

    /**
     * getDateCurrent function
     * @return array
     */
    public function getDateCurrent()
    {
        $dt = now('Asia/Ho_Chi_Minh');
        $day = date_format($dt,"d");
        $month = date_format($dt,"m");
        $year = date_format($dt,"Y");
        $date = date_format($dt, "Y-m-d");

        $time = date_format($dt,"H");
        $session = 0;

        if($time >= 8 && $time <= 12) {
            $session = 1;
        } 
        if($time >= 13 && $time <= 16) {
            $session = 2;
        }
        return [
            'day' => $day,
            'month' => $month,
            'year' => $year,
            'date' => $date,
            'time' => $time,
            'session' => $session,
        ];
    }
}
