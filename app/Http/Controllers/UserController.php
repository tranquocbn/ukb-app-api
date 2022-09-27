<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getInfoAccount()
    {
        return $this->userService->getInfo();
    }

    public function updateAccount(Request $request)
    {
        return $this->userService->updateAccount($request);
    }
}
