@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
      <h3 class="card-title">Daftar Pegawai</h3>
      <div class="card-tools">
        <div class="input-group input-group-sm">
            <select id="department" class="form-control">
                <option value="">--- Filter Unit Kerja ---</option>
                @forelse ($departments as $department)
                    <option value={{$department}}
                    {{ app('request')->input('filter') == $department ? 'selected':'' }}>{{$department}}</option>
                @empty
                    <option value="">Unit Kerja Kosong</option>
                @endforelse
            </select>
            <button onclick="clearFilter()" type="button" class="btn-info">Clear Filter</button>
            <div style="width:20px"></div>
            <input type="text" name="table_search" class="form-control float-right"
                id="search" placeholder="Search">
            <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
                </button>
            </div>
            <button onclick="clearSearch()" type="button" class="btn-info">Clear Search</button>
        </div>
      </div>
    </div>
    <div class="card-body table-responsive p-0">
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
                    Data dokter kosong.
                </td>
            @endforelse
        </tbody>
      </table>
    </div>
  </div>

  {{$datas->links('pagination::bootstrap-5')}}
@stop

@section('js')
<script src="{{ asset('js/axios.min.js') }}"></script>
<script>
    function clearFilter(){
        url = new URL(location.href);
        url.searchParams.delete('filter');
        window.location.href = url.href;
    };

    function clearSearch(){
        url = new URL(location.href);
        url.searchParams.delete('search');
        window.location.href = url.href;
    };

    $(document).ready(function(){
        let url = new URL(location.href);
        const urlParams = new URLSearchParams(location.search);
        $("#search").val(urlParams.get('search'));

        document.getElementById('department').addEventListener(
            'change', function(){
                url.searchParams.delete('filter');
                url.searchParams.append('filter',
                    this.options[this.selectedIndex].text
                );
                window.location.href = url.href;
        });

        document.getElementById('search').addEventListener(
            'change', function(){
                url.searchParams.delete('search');
                url.searchParams.append('search',
                    this.value
                );
                window.location.href = url.href;
        });
    });
</script>
@stop
