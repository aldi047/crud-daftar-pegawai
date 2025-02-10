<?php

namespace App\Http\Controllers;

use App\Models\EmployeeDetail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\EmployeeDetail;

class EmployeeController extends Controller
{
    public function getAllEmployees(Request $request):JsonResponse
    {
        try{
            $data = EmployeeDetail::all();

            if ($data) {
                return $this->returnJson(
                    $data,
                    message: 'Berhasil Mengambil Data Detail Pegawai'
                );
            } else {
                return $this->returnJson(
                    null,
                    code: 404,
                    message: 'Data Detail Pegawai Tidak Ditemukan'
                );
            }
        } catch(\Exception $exception){
            return $this->returnJson(
                code: 500,
                message: 'Gagal Mengambil Detail Pegawai: ' . $exception->getMessage()
            );
        }
    }


}
