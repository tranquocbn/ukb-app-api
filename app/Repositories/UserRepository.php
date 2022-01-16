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

     public function users()
     {
         return [
             ['id' => 1, 'name' => 'Quoc'],
             ['id' => 2, 'name' => 'Mai'],
             ['id' => 3, 'name' => 'Hoa'],
         ];
     }


}