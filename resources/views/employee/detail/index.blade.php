@extends('adminlte::page')

@section('title', 'Profile')

@section('content')
<div class="card mt-3">
    @if ($hasDetail)
        <div class="card-header bg-primary">
            <div class="card-title">
                <h5 class="mb-0">Employee Detail</h5>
            </div>
        </div>
        <div class="card-body pb-0 px-3">
        <div class="form-group">
            <label class="font-weight-bold">NIP</label>
            <input type="text" class="form-control"
                id="nip" disabled>
        </div>
        <div class="form-group">
            <label class="font-weight-bold">Golongan</label>
            <input type="text" class="form-control"
                id="group" disabled>
        </div>
        <div class="form-group">
            <label class="font-weight-bold" >Eselon</label><br>
            <select class="selectpicker" id="echelon" disabled>
                <option value="I">I</option>
                <option value="II">II</option>
                <option value="III">III</option>
                <option value="IV">IV</option>
                <option value="V">V</option>
            </select>
        </div>
        <div class="form-group">
            <label class="font-weight-bold">Jabatan</label>
            <input type="text" class="form-control"
                id="position" disabled>
        </div>
        <div class="form-group">
            <label class="font-weight-bold">Tempat Tugas</label>
            <input type="text" class="form-control"
                id="office_location" disabled>
        </div>
        <div class="form-group">
            <label class="font-weight-bold">Unit Kerja</label>
            <input type="text" class="form-control"
                id="department" disabled>
        </div>
        <a href="{{ route('details.edit', Auth::user()->id) }}" class="mb-3 mx-3">
            <button type="button" class="btn btn-outline-primary btn-block font-weight-bolder">Edit Detail</button>
        </a>
    @else
        <div class="alert alert-danger m-3" role="alert">
            Anda belum mengisi data detail pegawai
        </div>
        <a href="{{ route('details.add') }}" class="mb-3 mx-3">
            <button type="button" class="btn btn-outline-primary btn-block font-weight-bolder">Tambah Detail</button>
        </a>
    @endif
    </div>
</div>
@stop

@section('js')
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            var token = localStorage.getItem("crud_employee_token");
            var user_id = {{ Auth::user()->id }};
            axios({
                    method: "get",
                    url: location.origin
                        + "/api/employee/"
                        + user_id,
                    headers: {
                        'Authorization': token,
                        },
                }).then((res) => {
                    if (res.data.success){
                        $("#nip").val(res.data.content.nip)
                        $("#group").val(res.data.content.group)
                        $("#echelon").val(res.data.content.echelon).change()
                        $("#position").val(res.data.content.position)
                        $("#office_location").val(res.data.content.office_location)
                        $("#department").val(res.data.content.department)
                    }
                })
                .catch(err => console.log(err));
        });
    </script>
@stop
