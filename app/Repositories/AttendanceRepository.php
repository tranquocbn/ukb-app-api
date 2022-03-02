<?php
namespace App\Repositories;

use App\Models\Attendance;
class AttendanceRepository extends BaseRepository
{
    /**
     * @var Attendance
     */

    protected Attendance $attendance;

    public function model()
    {
        return Attendance::class;
    }
}