<table class="table table-hover text-nowrap">
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
                    {{ ((request()->page <= 0 ? 1 : request()->page) - 1) * $perPage + $loop->iteration }}
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
