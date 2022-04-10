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
        return $this->model
        ->whereCode($code)
        ->first();
    }

     public function test()
     {
         return $this->model
         ->select("*")
         ->with(['role' => function($e) {
             $e->where('id', 2);
         }])
         ->get();
     }
}