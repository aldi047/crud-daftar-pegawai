<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee</title>
    <style>
        table {
        border-collapse: collapse;
        }
        table, th, td {
        border: 1px solid;
        }
        div.page {
            position: absolute;
            top: 0px bottom: 0px;
            left: 0px;
            right: 0px;
            width: 100%;
            height: 100%;
            page-break-before: always;
        }
        div.page:first-child {
            page-break-before: avoid;
        }
    </style>
</head>
<body>
    <div class="page">
        <table class="table text-nowrap">
            <thead>
              <tr>
                <th>No</th>
                <th>NIP</th>
                <th>Nama</th>
                <th>Tempat Lahir</th>
                <th>Alamat</th>
                <th>Tgl Lahir</th>
                <th>L / P</th>
                <th>Gol</th>
                <th>Eselon</th>
                <th>Jabatan</th>
                <th>Tempat Tugas</th>
                <th>Agama</th>
                <th>Unit Kerja</th>
                <th>No. HP</th>
                <th>NPWP</th>
              </tr>
            </thead>
            <tbody>
                @forelse ($datas as $employee)
                    <tr>
                        <td class="align-middle">
                            {{ $loop->iteration }}
                        </td>
                        <td class="align-middle">{{ $employee->nip }}</td>
                        <td class="align-middle">{{ $employee->name }}</td>
                        <td class="align-middle">{{ $employee->birth_place }}</td>
                        <td class="align-middle">{{ $employee->address }}</td>
                        <td class="align-middle">{{ $employee->birth_date }}</td>
                        <td class="align-middle">{{ $employee->gender }}</td>
                        <td class="align-middle">{{ $employee->group }}</td>
                        <td class="align-middle">{{ $employee->echelon }}</td>
                        <td class="align-middle">{{ $employee->position }}</td>
                        <td class="align-middle">{{ $employee->office_location }}</td>
                        <td class="align-middle">{{ $employee->religion }}</td>
                        <td class="align-middle">{{ $employee->department }}</td>
                        <td class="align-middle">{{ $employee->phone_number }}</td>
                        <td class="align-middle">{{ $employee->npwp }}</td>
                    </tr>
                @empty
                    <td class="alert alert-danger text-center" colspan="6">
                        Data pegawai kosong.
                    </td>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>
