<?php

namespace App\Traits;

trait DateCalculateTrait 
{

    public function test()
    {
        echo '1';
    }

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