<?php
namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

    /**
     * info function
     *
     * @return mixed
     */
    public function info()
    {
        return Auth::user();
    }

    /**
     * update function
     *
     * @param $data
     * @return mixed
     */
    public function update($data)
    {
        if($data->has('_method')) {
            unset($data['_method']);
        }
        return $this->model
        ->where('code', $data['code'])
        ->update($data->toArray());
        // ->update([
        //         'gender' => $data['gender'],
        //         'phone' => $data['phone'],
        //         'address' => $data['address'],
        //         'email' => $data['email'],
        //         'birthday' => $data['birthday'],
        //         'avatar' => $data['avatar'],
        //     ]);
    }
}