<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Validation\Validator;
use Illuminate\Http\JsonResponse;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function returnJson(
        mixed $content = [],
        int $code = 200,
        string $message = 'Success'
    ): JsonResponse {
        return response()->json([
            'message' => $message,
            'content' => $content,
            'success' => $code == 200,
        ], $code);
    }

    protected function validationFail(Validator $validator): JsonResponse
    {
        return $this->returnJson(
            $validator->errors(),
            500,
            message: 'Mohon isi data dengan benar!',
        );
    }
}
