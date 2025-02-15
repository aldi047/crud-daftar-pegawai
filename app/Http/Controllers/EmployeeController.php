<?php

namespace App\Http\Controllers;

use App\Models\EmployeeDetail;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public function detail(Request $request, $id): JsonResponse
    {
        try{
            $user = User::findOrFail($id);
            if (!$user) {
                return $this->returnJson(
                    null,
                    code: 404,
                    message: 'Data Pegawai Tidak Ditemukan'
                );
            }

            $data = $user->employeeDetail;

            if ($data) {
                return $this->returnJson(
                    $data,
                    message: 'Berhasil Mengambil Data Detail Pegawai'
                );
            }
        } catch(\Exception $exception){
            return $this->returnJson(
                code: 500,
                message: 'Gagal Mengambil Detail Pegawai: ' . $exception->getMessage()
            );
        }
    }

    public function addEmployeeDetail(Request $request): JsonResponse
    {
        try{
            $validator = Validator::make($request->all(), [
                'user_id' => 'required',
                'nip' => Rule::unique('employee_details'),
                'group' => 'nullable',
                'echelon' => 'nullable',
                'position' => 'nullable',
                'office_location' => 'nullable',
                'department' => 'nullable'
            ]);

            if ($validator->fails()) return $this->validationFail($validator);

            $user = User::findOrFail($request->get('user_id'));
            if (!$user) {
                return $this->returnJson(
                    null,
                    code: 404,
                    message: 'Data Pegawai Tidak Ditemukan'
                );
            }
            $data = $user->employeeDetail()->create($request->all());

            return $this->returnJson(
                ['id' => $data->id],
                message: 'Berhasil Menambah Data Detail Pegawai'
            );
        } catch(\Exception $exception){
            return $this->returnJson(
                code: 500,
                message: 'Gagal Menambah Detail Pegawai: ' . $exception->getMessage()
            );
        }
    }

    public function updateEmployeeDetail(Request $request, $id):JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'nip' => Rule::unique('employee_details')->ignore($id),
                'group' => 'nullable',
                'echelon' => 'nullable',
                'position' => 'nullable',
                'office_location' => 'nullable',
                'department' => 'nullable'
            ]);

            if ($validator->fails()) return $this->validationFail($validator);

            $emplyeeDetail = EmployeeDetail::findOrFail($id);
            $emplyeeDetail->update($request->all());

            return $this->returnJson(
                message: 'Berhasil mengedit Detail Pegawai!'
            );
        } catch (\Exception $exception){
            return $this->returnJson(
                null, 500,
                'Gagal melakukan update data Detail Pegawai! ' . $exception->getMessage()
            );
        }
    }

    public function getDepartments(Request $request):JsonResponse
    {
        try {
            $data = DB::table('employee_details')
                    ->select('department')
                    ->distinct()
                    ->pluck('department');
            return $this->returnJson(
                content: $data,
                message: 'Berhasil mengambil daftar Unit Kerja'
            );
        } catch (\Exception $exception){
            return $this->returnJson(
                null, 500,
                'Gagal mengambil daftar Unit Kerja! ' . $exception->getMessage()
            );
        }
    }
}
