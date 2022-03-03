<?php
namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Request;

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

    /**
      * getIdClass function
      * @param $userId
      * @return mixed
      */
    public function getIdClass($userId)
    {
        return $this->model->find($userId)->userable->id;
    }
}