<?php

namespace App\Services;

use App\Repositories\NotifyRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class NotifyService extends BaseService
{
    protected NotifyRepository $notifyRepository;

    public function __construct(
        NotifyRepository $notifyRepository
    )
    {
        $this->notifyRepository = $notifyRepository;
    }

}
