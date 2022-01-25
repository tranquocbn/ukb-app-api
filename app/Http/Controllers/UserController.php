<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;


class UserController extends Controller
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
     * index function
     * 
     * @param Request $request
     */
    public function index(Request $request)
    {
        $users = $this->userService->getUsers();
        if($request->wantsJson()) {
            return $this->responseSuccess($users, 'get users list successfully');
        }
        return $this->responseSuccess($users, 'get users list successfully');

    }

    public function getList(Request $request)
    {
        $getList = $this->userService->getList();
        if($request->wantsJson()) {
            return $this->responseSuccess($getList, 'get users list successfully');
        }
        return $getList;
    }

    public function login(Request $request)
    {
        $code = '08d4800021';
        $pass = '1234';
        $user = $this->userService->checkInfoLogin($code, $pass);
       
        if($request->wantsJson()) {
            return $this->responseSuccess($user, 'login successfully');
        }
        return $user;
    }

    public function attendance(Request $request) 
    {
        $user_code = '08d4800021';
        $class_code = '08dCNTT02';
        $info = $this->userService->getInfoLesson($user_code, $class_code);

        if($request->wantsJson()) {
            return $this->responseSuccess($info, '');
        }
        return $info;
    }
}
