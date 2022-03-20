<?php
namespace App\Repositories;

use App\Models\Notify;
use Illuminate\Support\Facades\DB;

class NotifyRepository extends BaseRepository
{
    /**
     * @var Notify
     */

    protected Notify $notify;

    public function model()
    {
        return Notify::class;
    }

    public function notifyScore(array $arr)
    {
        return $this->model
                ->updateOrCreate($arr, $arr);
    }
}