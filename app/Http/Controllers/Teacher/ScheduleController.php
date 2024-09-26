<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ScheduleService;

class ScheduleController extends Controller
{
    private ScheduleService $scheduleService;
    /**
     * ScheduleController Constructor
     * @param 
     */
    public function __construct(ScheduleService $scheduleService)
    {
        $this->scheduleService = $scheduleService;
    }

    /**
     * getInfoLesson function
     * @param Request $request
     * @return mixed
     */
    public function getInfoLesson(Request $request)
    {
        return $this->scheduleService->getInfoLesson($request);
    }
}
