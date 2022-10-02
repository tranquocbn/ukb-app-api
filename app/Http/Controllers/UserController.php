<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\LoginRequest;
use App\Services\UserService;
class UserController extends Controller
{
    private UserService $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * login function
     *
     * @param LoginRequest $request
     * @return mixed
     */
    public function login(LoginRequest $request)
    {
       return $this->userService->login($request);
    }

    /**
     * logout function
     *
     * @param Request $request
     * @return mixed
     */
    public function logout(Request $request)
    {
        return $this->userService->logout($request);
    }

    /**
     * info function
     *
     * @return mixed
     */
    public function info()
    {
        return $this->userService->info();
    }

    /**
     * update function
     *
     * @param UpdateUserRequest $request
     * @param string $code
     * @return mixed
     */
    public function update(UpdateUserRequest $request, string $code)
    {
        $request->merge(['code' => $code]);
        return $this->userService->update($request);
    }
}
