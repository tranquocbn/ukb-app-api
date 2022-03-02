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
