<?php

namespace App\Services;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Lcobucci\JWT\Parser;
class UserService extends BaseService
{
    protected UserRepository $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
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

        unset($user['password'], $user['current_password']);
        
        $tokenResult = $user->createToken('ukb-api-token')->plainTextToken;
        return $this->resSuccessOrFail([
            'user' => $user,
            'token' => $tokenResult
        ], trans('text.account.login.successfully'));
    }

    /**
     * info function
     *
     * @return mixed
     */
    public function info()
    {
        return $this->userRepository->info();
    }

    /**
     * update function
     *
     * @param UpdateUserRequest $request
     * @return mixed
     */
    public function update(UpdateUserRequest $request)
    {
        if($this->userRepository->update($request)) {
            return $this->resSuccessOrFail(null, trans('text.account.update.successfully'));
        }
    }

    /**
     * logout function
     *
     * @param Request $request
     * @return mixed
     */
    public function logout(Request $request)
    {
        $user = $request->user()->toArray();
        if($request->user()->tokens()->delete()) {
            return $this->resSuccessOrFail($user, trans('text.account.logout.successfully'));
        }
    }
}
