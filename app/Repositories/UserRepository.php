<?php
namespace App\Repositories;

use App\Models\User;
use App\Models\Academic;
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

     
    public function getList()
    {
        return Academic::find(2);
        // return ['id' => '1', 'name' => 'Mai Vu'];
    }


}