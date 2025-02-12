@extends('adminlte::page')

@section('title', 'Edit Employee Biodata')

@section('content')
<div class="card mt-3">
    <div class="card-header bg-primary">
        <div class="card-title">
            <h5 class="mb-0">Employee Biodata</h5>
        </div>
    </div>
    <div class="card-body pb-0 px-3">
        <form id = "formAdd">
            <div class="card-body p-0">
                @csrf
                <div class="form-group">
                    <label class="font-weight-bold">NPWP</label>
                    <input type="text" class="form-control" id="npwp"
                    name="npwp" value="{{ old('npwp', '') }}">

                    <!-- error message npwp-->
                    @error('npwp')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Tempat Lahir</label>
                    <input type="text" class="form-control" id="birth_place"
                    name="birth_place" value="{{ old('birth_place', '') }}">

                    <!-- error message birth_place-->
                    @error('birth_place')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Tahun Lahir</label>
                    <input type="text" class="form-control datepicker" id="birth_date"
                    name="birth_date" value="{{ old('birth_date', '') }}">

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
                    name="address" value="{{ old('address', '') }}">

                    <!-- error message address-->
                    @error('address')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="radio-gender">
                    <label class="font-weight-bold">L / P</label><br>
                    <div class="icheck-primary icheck-inline">
                        <input type="radio" id="radioGenderL" value="L"
                        name="gender"/>
                        <label for="radioGenderL">L</label>
                    </div>
                    <div class="icheck-primary icheck-inline">
                        <input type="radio" id="radioGenderP" value="P"
                        name="gender"/>
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
                    name="phone_number" value="{{ old('phone_number', '') }}">

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
                    name="religion" value="{{ old('religion', '') }}">

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
                format: 'dd-mm-yyyy',
                clearBtn: true,
                orientation: "bottom auto",
                autoclose: true,
            });

            const form = document.getElementById('formAdd');
            var token = localStorage.getItem("crud_employee_token");
            var user_id = {{ Auth::user()->id }};
            let BioId = 0;
            axios({
                method: "get",
                url: location.origin
                    + "/api/biodata/"
                    + user_id,
                headers: {
                    'Authorization': token,
                    },
            }).then((res) => {
                if (res.data.success){
                    BioId = res.data.content.id
                    $("#npwp").val(res.data.content.npwp)
                    $("#birth_place").val(res.data.content.birth_place)
                    $("#birth_date").val(res.data.content.birth_date)
                    $("#address").val(res.data.content.address)
                    if (res.data.content.gender == 'L')
                        $('.radio-gender').find(':radio[name=gender][value="L"]').prop('checked', true);
                    else
                        $('.radio-gender').find(':radio[name=gender][value="P"]').prop('checked', true);
                    $("#phone_number").val(res.data.content.phone_number)
                    $("#religion").val(res.data.content.religion)
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
                        + "/api/biodata/"
                        + BioId
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
