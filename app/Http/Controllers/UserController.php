<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

    public function getAllData(Request $request)
    {
        $perPage = $request->get('perPage') ?? 5;
        $filter = $request->get('filter');
        $search = $request->get('search');
        $cols= [
            'employee_details.nip',
            'users.name',
            'personal_biodatas.birth_place',
            'personal_biodatas.address',
            'personal_biodatas.birth_date',
            'personal_biodatas.gender',
            'employee_details.group',
            'employee_details.echelon',
            'employee_details.position',
            'employee_details.office_location',
            'personal_biodatas.religion',
            'employee_details.department',
            'personal_biodatas.phone_number',
            'personal_biodatas.npwp'
        ];

        $departments = DB::table('employee_details')
            ->select('department')
            ->distinct()
            ->pluck('department');

        $res = DB::table('users')
            ->join('employee_details', 'users.id', '=', 'employee_details.user_id')
            ->join('personal_biodatas', 'users.id', '=', 'personal_biodatas.user_id')
            ->select($cols)
            ->when($filter, function ($q) use ($filter) {
                $q->where('department', $filter);
            })
            ->when($search, function ($q) use ($search) {
                $q->whereLike('name', "%{$search}%");
            });

        $datas = $perPage ? $res->paginate($perPage) : $res->get();

        return view('dashboard', compact('datas', 'departments', 'perPage'));
    }

    public function printToPDF(Request $request)
    {
        $cols= [
            'employee_details.nip',
            'users.name',
            'personal_biodatas.birth_place',
            'personal_biodatas.address',
            'personal_biodatas.birth_date',
            'personal_biodatas.gender',
            'employee_details.group',
            'employee_details.echelon',
            'employee_details.position',
            'employee_details.office_location',
            'personal_biodatas.religion',
            'employee_details.department',
            'personal_biodatas.phone_number',
            'personal_biodatas.npwp'
        ];

        $datas = DB::table('users')
            ->join('employee_details', 'users.id', '=', 'employee_details.user_id')
            ->join('personal_biodatas', 'users.id', '=', 'personal_biodatas.user_id')
            ->select($cols)->get()->toArray();

        $pdf = Pdf::loadView('data_print', ['datas' => $datas]);

        return $pdf->download('employee.pdf');
    }

    public function pdf(Request $request)
    {
        $cols= [
            'employee_details.nip',
            'users.name',
            'personal_biodatas.birth_place',
            'personal_biodatas.address',
            'personal_biodatas.birth_date',
            'personal_biodatas.gender',
            'employee_details.group',
            'employee_details.echelon',
            'employee_details.position',
            'employee_details.office_location',
            'personal_biodatas.religion',
            'employee_details.department',
            'personal_biodatas.phone_number',
            'personal_biodatas.npwp'
        ];

        $datas = DB::table('users')
            ->join('employee_details', 'users.id', '=', 'employee_details.user_id')
            ->join('personal_biodatas', 'users.id', '=', 'personal_biodatas.user_id')
            ->select($cols)->get()->toArray();

        return view('data_print', compact('datas'));
    }
}
