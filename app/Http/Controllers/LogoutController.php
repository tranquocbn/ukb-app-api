<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    private UserService $userService;

    /**
     * LogoutController Constructor
     *
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
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
}
