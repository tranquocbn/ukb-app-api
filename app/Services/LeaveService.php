<?php

namespace App\Services;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\ScheduleRepository;
use Illuminate\Support\Facades\Hash;

class LeaveService extends BaseService
{
    protected ScheduleRepository $scheduleRepository;

    /**
     * @param ScheduleRepository $scheduleRepository
     */
    public function __construct(ScheduleRepository $scheduleRepository)
    {
        $this->scheduleRepository = $scheduleRepository;
    }

     /**
     * 2021: 1
     * 2022: 2, 3 = 
     * 2023: 4, 5
     * 
     * year_current - year_start = a * 2
     * xac dinh ky: 
     * t 1-> 6: a *2
     * t6->12: a* 2 + 1
     * 
     * semester
     * @param year_current, month_current
     *
     */
    public function semester($year_start, $year_current, $month_current)
    {           
        if ($year_current === $year_start) {
            return 1;
        }

        if ($month_current >= 1 && $month_current < 6) {
            return ($year_current - $year_start) * 2;
        }

        if ($month_current >= 6 && $month_current <= 12) {
            return ($year_current - $year_start) * 2 + 1;
        }
    }


    /**
     * get subjects in semester current
     * 
     * @param REquest $req
     * 
     * @return mixed
     */
    public function getSubjectsInSemesterCurrent(Request $req)
    {
       
        $semester = $this->semester((int)$req->year_start, (int)$req->year_current, (int)$req->month_current);
        $subjects = $this->leaveRepository->getSubjectsInSemesterCurrent($req->class_id, $semester);

        return $subjects;
    }



    /**
     * login function
     *
     * @param LoginRequest $request
     * @return mixed
     */
    public function login(LoginRequest $request)
    {
        $user = $this->userRepository->getByCode($request->code);
        if(!$user) {
            return $this->resSuccessOrFail(null, trans('text.account.login.fail.user'), Response::HTTP_UNAUTHORIZED);
        }
        
        if(!Hash::check($request->password, $user->password)) {
            return $this->resSuccessOrFail(null, trans('text.account.login.fail.password'), Response::HTTP_UNAUTHORIZED);
        }

        $tokenResult = $user->createToken('ukb-api-token')->plainTextToken;
        return $this->resSuccessOrFail([
            'user' => $user,
            'token' => $tokenResult
        ], trans('text.account.login_successfully'));
    }
}
