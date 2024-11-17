<?php

namespace App\Common;

use Illuminate\Http\JsonResponse;

class ResponseClass
{
    public function apiResponse($code, $message = "", $errors = null, $data = null)
    {
        if (!is_null($errors)) {
            if (!is_object($errors)) {
                $errors = (object) $errors;
            }
        }
        return response()->json(
            [
                'message' => $message,
                'errors'  => $errors,
                'data'    => $data,
                'code'    => $code,
            ],
            $code
        );
    }
}
