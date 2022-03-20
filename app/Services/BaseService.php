<?php

namespace App\Services;
use Illuminate\Http\Response;

class BaseService
{
    protected function resSuccessOrFail(array $data = null, string $msg = null, int $status = Response::HTTP_OK)
    {
        $dataRes = ['status' => $status];

        if($msg !== null) {
            $dataRes['message'] = $msg;
        }

        if($data !== null) {
            $dataRes['data'] = $data;
        }
        return response()->json($dataRes, $status);
    }

}
