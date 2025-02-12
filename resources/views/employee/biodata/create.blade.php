@extends('adminlte::page')

@section('title', 'Add Employee Biodata')

@section('content')
<div class="card mt-3">
    <div class="card-header bg-primary">
        <div class="card-title">
            <h5 class="mb-0">Personal Biodata</h5>
        </div>
    </div>
    <div class="card-body pb-0 px-3">
        <form id = "formAdd">
            <div class="card-body p-0">
                @csrf
                <div class="form-group">
                    <label class="font-weight-bold">NPWP</label>
                    <input type="text" class="form-control" id="npwp"
                    name="npwp">

                    <!-- error message npwp-->
                    @error('npwp')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Tempat Lahir</label>
                    <input type="text" class="form-control" id="birth_date"
                    name="birth_place">

                    <!-- error message birth_place-->
                    @error('birth_place')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Tahun Lahir</label><br>
                    <input class="datepicker form-control" id="birth_place"
                    name="birth_date">

                    <!-- error message birth_date-->
                    @error('birth_date')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Alamat</label>
                    <input type="text" class="form-control" id="address"
                    name="address">

                    <!-- error message address-->
                    @error('address')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div>
                    <label class="font-weight-bold">L / P</label><br>
                    <div class="icheck-primary icheck-inline">
                        <input type="radio" id="radioGenderL" value="L" name="gender" />
                        <label for="radioGenderL">L</label>
                    </div>
                    <div class="icheck-primary icheck-inline">
                        <input type="radio" id="radioGenderP" value="P" name="gender" />
                        <label for="radioGenderP">P</label>
                    </div>

                    <!-- error message gender-->
                    @error('gender')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Nomor Telepon</label>
                    <input type="text" class="form-control" id="phone_number"
                    name="phone_number">

                    <!-- error message phone_number-->
                    @error('phone_number')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Agama</label>
                    <input type="text" class="form-control" id="religion"
                    name="religion">

                    <!-- error message religion-->
                    @error('religion')
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
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                clearBtn: true,
                orientation: "bottom auto",
                autoclose: true,
            });
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
                        + "/api/personalBiodata",
                    data: formData,
                    headers: {
                        'Authorization': token
                        }
                }).then((res) => {
                    if (res.data.success){
                        let msg = res.data.message;
                        window.location.href = "/redirectWith?route=biodatas&msg=" + msg;
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
