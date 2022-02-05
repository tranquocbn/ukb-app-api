<?php
namespace App\Repositories;

use App\Models\User;

class UserRepository {
    /**
     * @var User
     */

     protected User $user;

     public function __construct(User $user)
     {
        $this->user = $user;
     }

     /**
      * getByCode function
      *
      * @param string $code
      * @return mixed
      */
     public function getByCode(string $code)
     {
        return $this->user->whereCode($code)->first();
     }
}