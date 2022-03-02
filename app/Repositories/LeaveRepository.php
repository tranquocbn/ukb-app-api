<?php
namespace App\Repositories;

use App\Models\Leave;

class LeaveRepository extends BaseRepository{

    public function model()
    {
        return Leave::class;
    }

    public function getDateWant($userId, $date)
    {
        return $this->model
            ->where('user_id', $userId)
            ->where('date_want', $date)
            ->get()
            ->pluck('date_want');
    }
}
