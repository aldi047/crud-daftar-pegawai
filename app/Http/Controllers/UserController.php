<?php

namespace App\Http\Controllers;

use App\Models\User;
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
            $validator = Validator::make($request->all(), [
                'name' => 'nullable',
                'photo' => 'image'
            ]);
            if ($validator->fails()) return $this->validationFail($validator);

            $name = $request->name;
            $photo = $request->file('photo');

            $user = User::findOrFail($id);
            if (!$user) {
                return $this->returnJson(
                    null,
                    code: 404,
                    message: 'Data Pegawai Tidak Ditemukan'
                );
            }

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

    public function deleteProfile(Request $request, $id):JsonResponse
    {
        try {
            $user = User::findOrFail($id);
            if (!$user) {
                return $this->returnJson(
                    null,
                    code: 404,
                    message: 'Data Pegawai Tidak Ditemukan'
                );
            }

            $user->delete();

            return $this->returnJson(
                message: 'Berhasil Menghapus profil!'
            );
        } catch (\Exception $exception){
            return $this->returnJson(
                null, 500,
                'Gagal menghapus profil! ' . $exception->getMessage()
            );
        }
    }
}
