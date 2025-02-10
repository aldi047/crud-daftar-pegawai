<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Validation\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class Controller extends BaseController
{

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

    protected function processFileName($file, $folder = 'profile') {
        if (!empty($file) && $file instanceof UploadedFile) {
            $date = Carbon::now()->format('YmdHisu') . Str::random(6);
            $originalExtension = $file->getClientOriginalExtension();
            $filename = "{$date}_profile.{$originalExtension}";

            $path = $file->storeAs($folder, $filename, 'public');

            return url('/') . "/storage/{$path}";
        }
        return '';
    }
}
