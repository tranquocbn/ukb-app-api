<?php

namespace App\Services;
use Illuminate\Http\Response;

class BaseService
{
    protected function resSuccessOrFail(array $data = null, string $msg, int $status = Response::HTTP_OK)
    {
        $dataRes = [
            'message' => $msg,
            'status' => $status
        ];

        if($data !== null) {
            $dataRes['data'] = $data;
        }
        return response()->json($dataRes, $status);
    }

}
