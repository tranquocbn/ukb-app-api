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
}
