<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param array $data
     * @param string $msg
     * @return Response
     */
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
