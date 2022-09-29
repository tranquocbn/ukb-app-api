<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AccountRequest;
use App\Services\UserService;
class UserController extends Controller
{
    protected UserService $userService;

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
     * @param AccountRequest $request
     * @return mixed
     */
    public function update(AccountRequest $request)
    {
        return $this->userService->update($request);
    }
}
