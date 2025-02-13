<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonalBiodata;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class BiodataController extends Controller
{
    private function stringToDbDate($date)
    {
        $date = Carbon::createFromFormat('Y-m-d', $date);
        return $date->toDateTimeString();
    }

    public function biodata(Request $request, $id): JsonResponse
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

            $data = $user->personalBiodata;

            if ($data) {
                return $this->returnJson(
                    $data,
                    message: 'Berhasil Mengambil Data Personal Bidoata'
                );
            }
        } catch(\Exception $exception){
            return $this->returnJson(
                code: 500,
                message: 'Gagal Mengambil Personal Bidoata: ' . $exception->getMessage()
            );
        }
    }

    public function addPersonalBiodata(Request $request): JsonResponse
    {
        try{
            $validator = Validator::make($request->all(), [
                'user_id' => 'required',
                'npwp' => 'required|unique:personal_biodatas',
                'birth_place' => 'required',
                'birth_date' => 'required',
                'address' => 'required',
                'gender' => 'required',
                'phone_number' => 'required',
                'religion' => 'required'
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

            $data = $request->all();
            $data['birth_date'] = $this->stringToDbDate($data['birth_date']);
            $inserted_data = $user->personalBiodata()->create($request->all());

            return $this->returnJson(
                ['id' => $inserted_data->id],
                message: 'Berhasil Menambah Data Personal Bidoata'
            );
        } catch(\Exception $exception){
            return $this->returnJson(
                code: 500,
                message: 'Gagal Menambah Personal Bidoata: ' . $exception->getMessage()
            );
        }
    }

    public function updatePersonalBiodata(Request $request, $id):JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'npwp' => Rule::unique('personal_biodatas')->ignore($id),
                'birth_place' => 'nullable',
                'birth_date' => 'nullable',
                'address' => 'nullable',
                'gender' => 'nullable',
                'phone_number' => 'nullable',
                'religion' => 'nullable'
            ]);

            if ($validator->fails()) return $this->validationFail($validator);

            $personalBiodata = PersonalBiodata::findOrFail($id);

            $data = $request->all();
            $data['birth_date'] = $this->stringToDbDate($data['birth_date']);

            $personalBiodata->update($request->all());

            return $this->returnJson(
                message: 'Berhasil mengedit data Personal Biodata!'
            );
        } catch (\Exception $exception){
            return $this->returnJson(
                null, 500,
                'Gagal melakukan update data Personal Biodata! ' . $exception->getMessage()
            );
        }
    }
}
