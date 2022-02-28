<?php
namespace App\Repositories;

use App\Models\Leave;
use Illuminate\Support\Facades\DB;

class LeaveRepository extends BaseRepository{

    public function model()
    {
        return Leave::class;
    }

    /**
     * student create leave
     *
     * @param array $data
     * @return mix
     */
    public function studentCreate(array $data)
    {
        return $this->create($data);
    }

    /**
     * check date select student
     *
     * @param array $data
     * @return mix
     */
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

    public function studentLeavesSemester(array $data)
    {
        return $this->model
        ->where('user_id', $data['user_id'])
        ->where('schedule_id', $data['schedule_id'])
        ->get();
    }


}

