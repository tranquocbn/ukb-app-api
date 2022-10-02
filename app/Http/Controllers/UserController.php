<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
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
