<?php

namespace App\Traits;

trait DateCalculateTrait 
{
    /**
     * dateDiff
     *
     * @param [type] $dateStart
     * @param [type] $dateSecond
     * @return int
     */
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

        $time = date_format($dt,"H:i:s");
        $hour = date_format($dt,"H");
        $session = 0;

        if($time >= 8 && $time <= 12) {
            $session = AM;
        } 
        if($time >= 13 && $time <= 16) {
            $session = PM;
        }
        return [
            'day' => $day,
            'month' => $month,
            'year' => $year,
            'date' => $date,
            'time' => $time,
            'hour' => $hour,
            'session' => $session,
        ];
    }
}