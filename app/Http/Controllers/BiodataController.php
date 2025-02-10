<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonalBiodata;

class BiodataController extends Controller
{
    public function getAllPersonalBiodata(Request $request):JsonResponse
    {
        try{
            $data = PersonalBiodata::all();

            if ($data) {
                return $this->returnJson(
                    $data,
                    message: 'Berhasil Mengambil Data Personal Biodata'
                );
            } else {
                return $this->returnJson(
                    null,
                    code: 404,
                    message: 'Data Personal Biodata Tidak Ditemukan'
                );
            }
        } catch(\Exception $exception){
            return $this->returnJson(
                code: 500,
                message: 'Gagal Mengambil Personal Biodata: ' . $exception->getMessage()
            );
        }
    }
}
