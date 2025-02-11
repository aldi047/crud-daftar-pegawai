@extends('adminlte::page')

@section('title', 'Edit Employee Detail')

@section('content')
<div class="card mt-3">
    <div class="card-header bg-primary">
        <div class="card-title">
            <h5 class="mb-0">Employee Profile</h5>
        </div>
    </div>
    <div class="card-body pb-0 px-3">
        <form id = "formAdd">
            <div class="card-body p-0">
                @csrf
                <div class="form-group">
                    <label class="font-weight-bold">NIP</label>
                    <input type="text" class="form-control" id="nip"
                    name="nip" value="{{ old('nip', '') }}">

                    <!-- error message nip-->
                    @error('nip')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Golongan</label>
                    <input type="text" class="form-control" id="group"
                    name="group" value="{{ old('group', '') }}">

                    <!-- error message group-->
                    @error('group')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Eselon</label>
                    <input type="text" class="form-control" id="echelon"
                    name="echelon" value="{{ old('echelon', '') }}">

                    <!-- error message echelon-->
                    @error('echelon')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Jabatan</label>
                    <input type="text" class="form-control" id="position"
                    name="position" value="{{ old('position', '') }}">

                    <!-- error message position-->
                    @error('position')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Tempat Tugas</label>
                    <input type="text" class="form-control" id="office_location"
                    name="office_location" value="{{ old('office_location', '') }}">

                    <!-- error message office_location-->
                    @error('office_location')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Unit Kerja</label>
                    <input type="text" class="form-control" id="department"
                    name="department" value="{{ old('department', '') }}">

                    <!-- error message department-->
                    @error('department')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-outline-success btn-block font-weight-bolder my-3">Simpan</button>
        </form>
    </div>
</div>
@stop

@section('js')
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            const form = document.getElementById('formAdd');
            var token = localStorage.getItem("crud_employee_token");
            var user_id = {{ Auth::user()->id }};
            let employeeDetailId = 0;
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
                    employeeDetailId = res.data.content.id;
                    $("#nip").val(res.data.content.nip);
                    $("#group").val(res.data.content.group);
                    $("#echelon").val(res.data.content.echelon);
                    $("#position").val(res.data.content.position);
                    $("#office_location").val(res.data.content.office_location);
                    $("#department").val(res.data.content.department);
                }
            })
            .catch(err => console.log(err));

            form.addEventListener("submit", (e) => {
                e.preventDefault();

                var formData = new FormData(form);
                formData.append('user_id', user_id);
                axios({
                    method: "post",
                    url: location.origin
                        + "/api/employee/"
                        + employeeDetailId
                        + "/edit",
                    data: formData,
                    headers: {
                        'Authorization': token
                    },
                    params: {
                    _method:'PUT'
                    }
                }).then((res) => {
                    console.log(res.status);
                    if (res.data.success){
                        let msg = res.data.message;
                        window.location.href = "/redirectWith?route=details&msg=" + msg;
                    }
                })
                .catch((err) => {
                    console.log(err);
                    let detail_message = JSON.stringify(err.response.data.content);
                    toastr.error(detail_message, err.response.data.message);
                });
            })
        });
    </script>
@stop
