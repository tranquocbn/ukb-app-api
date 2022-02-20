<?php
namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository {

    public function model()
    {
        return User::class;
    }

    /**
      * getByCode function
      *
      * @param string $code
      * @return mixed
      */
     public function getByCode(string $code)
     {
        return $this->model->whereCode($code)->first();
     }
}