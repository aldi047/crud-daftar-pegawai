@extends('adminlte::page')

@section('title', 'Add Employee Detail')

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
                    name="nip">

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
                    name="group">

                    <!-- error message group-->
                    @error('group')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div>
                    <label class="font-weight-bold" >Eselon</label><br>
                    <select class="selectpicker" id="echelon" name="echelon">
                        <option value="" disabled selected>Pilih Eselon</option>
                        <option value="I">I</option>
                        <option value="II">II</option>
                        <option value="III">III</option>
                        <option value="IV">IV</option>
                        <option value="V">V</option>
                    </select>

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
                    name="position">

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
                    name="office_location">

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
                    name="department">

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

            form.addEventListener("submit", (e) => {
                e.preventDefault();

                var formData = new FormData(form);
                formData.append('user_id', user_id);
                axios({
                    method: "post",
                    url: location.origin
                        + "/api/employeeDetail",
                    data: formData,
                    headers: {
                        'Authorization': token
                        }
                }).then((res) => {
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
