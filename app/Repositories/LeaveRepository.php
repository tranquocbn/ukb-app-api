<?php
namespace App\Repositories;

use App\Models\Leave;
use Illuminate\Support\Facades\DB;

class LeaveRepository extends BaseRepository{

    public function model()
    {
        return Leave::class;
    }

    public function studentCreate(array $data)
    {
        return $this->create($data);
    }

    public function checkDateLeaveEnable(array $data)
    {
        //dung: null, sai: co dl
        return $this->model->select("*")
        ->where('user_id', $data['teacher_id'])
        ->where('schedule_id', $data['schedule_id'])
        ->when($data['date_diff'] % 7 == 0, function($e) use ($data) {
            $e->where('date_want', $data['date_selected']);
        }, function($e) use ($data) {
            $e->where('date_change', '<>', $data['date_selected']);
        })->get();
    }

    // public function checkDateLeaveEnable(array $data)
    // {
    //     return $this->model
    //     ->where('schedule_id', $data['schedule_id'])
    //     ->whereRaw('DATEDIFF(?, ?) % 7 = 0', [$data['date_selected'], $data['date_start']])
    //     ->get();
    // }

    // /**
    //  * getDateChanges
    //  *
    //  * @param $scheduleId
    //  * @param $userId
    //  * @return mixed
    //  */
    // public function getDateChanges($scheduleId, $userId)
    // {
    //     return $this->model
    //     ->where('schedule_id', $scheduleId)
    //     ->where('user_id', $userId)
    //     ->get()
    //     ->pluck('date_change');
    // }
}

