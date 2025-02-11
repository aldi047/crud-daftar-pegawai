<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class UserController extends Controller
{
    public function update(Request $request, $id):JsonResponse
    {
        try {
            $name = $request->name;
            $photo = $request->file('photo');

            $user = Auth::user();

            if ($name) $user->name = $name;

            if ($photo){
                if ($user->photo_path){
                    $this->deleteFile($user->photo_path);
                }

                $new_path = $this->uploadFile($photo);
                $user->photo_path = $new_path;
            }

            $user->save();

            return $this->returnJson(
                message: 'Berhasil mengedit profil!'
            );
        } catch (\Exception $exception){
            return $this->returnJson(
                null, 500,
                'Gagal melakukan update data user! ' . $exception->getMessage()
            );
        }
    }
}
