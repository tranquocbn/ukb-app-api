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
      * getByEmail function
      *
      * @param string $email
      * @return mixed
      */
     public function getByEmail(string $email)
     {
        return $this->user->whereEmail($email)->first();
     }
}