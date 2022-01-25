<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    /**
     * @var $userRepository
     */
    protected UserRepository $userRepository;

    /**
     * UserService Constructor
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return array
     */
    public function getUsers()
    {
        return $this->userRepository->users();
    }

    public function getList()
    {
        return $this->userRepository->getList();
    }

    /**
     * check info login status
     * @param $code, $pass
     * @return array
     */
    public function checkInfoLogin($code, $pass)
    {
        $user = $this->userRepository->findUserByCode($code);
        if(! $user) {
            return 'Mã không tồn tại';
        } else {
            $user = $this->userRepository->checkInfoLogin($code, $pass);
            if(! $user) {
                return 'Thông tin đăng nhập không chính xác';
            } else {
                return $user;
            }
        }
    }

}
