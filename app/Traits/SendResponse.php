<?php

namespace App\Traits;

trait SendResponse
{
    public function sendResponse($status_code, $message , $data = null)
    {
        $response = [
            'status_code' => $status_code,
            'message' => $message,
        ];

        if ($data) {
            $response['data'] = $data;
        }

        return response()->json($response, $status_code);
    }


}
