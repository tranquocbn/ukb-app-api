<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\UserService;

class LoginController extends Controller
{
    private UserService $userService;

    /**
     * UserController Constructor
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
}
