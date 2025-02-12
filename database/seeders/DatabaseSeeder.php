<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\EmployeeDetail;
use App\Models\PersonalBiodata;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        function stringToDate($date)
        {
            $date = Carbon::createFromFormat('d-m-Y', $date);
            return $date->toDateTimeString();
        }

        User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'user_type' => 'admin',
            'password' => Hash::make('qwqwqwqw')
        ]);

        $users = [
            [
                'name' => 'Saifulloh Rifai',
                'email' => 'saifulloh@gmail.com',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Rudi Hartono',
                'email' => 'rudihartono@gmail.com',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Fahmi Zulfikar',
                'email' => 'fahmizulfikar@gmail.com',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Siti Rahmawati',
                'email' => 'sitirahmawati@gmail.com',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Dani Hendra',
                'email' => 'danihendra@gmail.com',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Hidayat Wira',
                'email' => 'hidayatwira@gmail.com',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Aminah Putri',
                'email' => 'aminahputri@gmail.com',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Agus Setiawan',
                'email' => 'agussetiawan@gmail.com',
                'password' => Hash::make('password')
            ],
        ];

        $employees = [
            [
                'nip' => '123456789012345001',
                'group' => 'IV/d',
                'echelon' => 'I',
                'position' => 'Kepala Sekretariat Utama',
                'office_location' => 'Jakarta',
                'department' => 'Kantor Pusat'
            ],
            [
                'nip' => '123456789012345002',
                'group' => 'IV/a',
                'echelon' => 'II',
                'position' => 'Penyusun laporan keuangan',
                'office_location' => 'Bandung',
                'department' => 'Biro Keuangan'
            ],
            [
                'nip' => '123456789012345003',
                'group' => 'III/c',
                'echelon' => 'III',
                'position' => 'Surveyor Pemetaan Pertama',
                'office_location' => 'Bali',
                'department' => 'BPS'
            ],
            [
                'nip' => '123456789012345004',
                'group' => 'III/b',
                'echelon' => 'IV',
                'position' => 'Analis Data Survei dan Pemetaan',
                'office_location' => 'Solo',
                'department' => 'BPS'
            ],
            [
                'nip' => '123456789012345005',
                'group' => 'III/a',
                'echelon' => 'V',
                'position' => 'Perancang Per-UU-an Utama',
                'office_location' => 'Medan',
                'department' => 'Biro Hukum'
            ],
            [
                'nip' => '123456789012345006',
                'group' => 'IV/c',
                'echelon' => 'IV',
                'position' => 'Kepala Biro Perencanaan',
                'office_location' => 'Bandung',
                'department' => 'Biro Perencanaan'
            ],
            [
                'nip' => '123456789012345007',
                'group' => 'IV/d',
                'echelon' => 'V',
                'position' => 'Peneliti Pertama',
                'office_location' => 'Bali',
                'department' => 'Biro Penelitian'
            ],
            [
                'nip' => '123456789012345008',
                'group' => 'IV/d',
                'echelon' => 'V',
                'position' => 'Auditor Terampil',
                'office_location' => 'Jakarta',
                'department' => 'Biro Keuangan'
            ],
        ];

        $biodatas = [
            [
                'npwp' => '1234567890123001',
                'birth_place' => 'Banjarnegara',
                'birth_date' => stringToDate('5-03-1968'),
                'address' => 'Jl. Melon No.16 Dian Asri',
                'gender' => 'L',
                'phone_number' => '089512345001',
                'religion' => 'Islam'
            ],
            [
                'npwp' => '1234567890123002',
                'birth_place' => 'Surabaya',
                'birth_date' => stringToDate('27-08-1968'),
                'address' => 'Jl. Golf Komp Bakosurtanal No.39',
                'gender' => 'L',
                'phone_number' => '089512345002',
                'religion' => 'Islam'
            ],
            [
                'npwp' => '1234567890123003',
                'birth_place' => 'Yogyakarta',
                'birth_date' => stringToDate('10-07-1987'),
                'address' => 'Jl. Mendut III, Puri Nirwana I RT.03/16',
                'gender' => 'L',
                'phone_number' => '089512345003',
                'religion' => 'Islam'
            ],
            [
                'npwp' => '1234567890123004',
                'birth_place' => 'Semarang',
                'birth_date' => stringToDate('03-05-1987'),
                'address' => 'Perum Jombor Baru',
                'gender' => 'L',
                'phone_number' => '089512345004',
                'religion' => 'Islam'
            ],
            [
                'npwp' => '1234567890123005',
                'birth_place' => 'Trengalek',
                'birth_date' => stringToDate('07-07-1992'),
                'address' => 'Trengalek',
                'gender' => 'L',
                'phone_number' => '089512345005',
                'religion' => 'Islam'
            ],
            [
                'npwp' => '1234567890123006',
                'birth_place' => 'Bali',
                'birth_date' => stringToDate('05-06-1963'),
                'address' => 'Bella Casa Residence Blok E.1 No.9',
                'gender' => 'L',
                'phone_number' => '089512345006',
                'religion' => 'Islam'
            ],
            [
                'npwp' => '1234567890123007',
                'birth_place' => 'Bogor',
                'birth_date' => stringToDate('07-11-1952'),
                'address' => 'Jl. Pelita I/18 Kedung Halang Talang',
                'gender' => 'P',
                'phone_number' => '089512345007',
                'religion' => 'Islam'
            ],
            [
                'npwp' => '1234567890123008',
                'birth_place' => 'Surabaya',
                'birth_date' => stringToDate('12-09-1954'),
                'address' => 'Komp. BAKOSURTANAL CIKARET',
                'gender' => 'L',
                'phone_number' => '089512345008',
                'religion' => 'Islam'
            ],
        ];

        $user_ids = [];
        foreach ($users as $user)
        {
            $inserted_user = User::query()->create($user);
            array_push($user_ids, $inserted_user->id);
        }
        foreach ($user_ids as $key=>$value)
        {
            $employees[$key]['user_id'] = $value;
            $biodatas[$key]['user_id'] = $value;
        }

        foreach ($employees as $employee)
        {
            EmployeeDetail::query()->create($employee);
        }

        foreach ($biodatas as $biodata)
        {
            PersonalBiodata::query()->create($biodata);
        }


    }
}
