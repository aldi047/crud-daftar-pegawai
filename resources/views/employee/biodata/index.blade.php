@extends('adminlte::page')

@section('title', 'Profile')

@section('content')
<div class="card mt-3">
    @if ($hasBio)
        <div class="card-header bg-primary">
            <div class="card-title">
                <h5 class="mb-0">Personal Biodata</h5>
            </div>
        </div>
        <div class="card-body pb-0 px-3">
            <div class="form-group">
                <label class="font-weight-bold">NIP</label>
                <input type="text" class="form-control" id="npwp"
                    name="npwp" disabled>
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Tempat Lahir</label>
                <input type="text" class="form-control" id="birth_date"
                    name="birth_place" disabled>
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Tahun Lahir</label><br>
                <input class="datepicker form-control" id="birth_place"
                    name="birth_date" disabled>
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Alamat</label>
                <input type="text" class="form-control" id="address"
                    name="address" disabled>
            </div>
            <div class="radio-gender">
                <label class="font-weight-bold">L / P</label><br>
                <div class="icheck-primary icheck-inline">
                    <input type="radio" id="radioGenderL" value="L"
                    name="gender" disabled/>
                    <label for="radioGenderL">L</label>
                </div>
                <div class="icheck-primary icheck-inline">
                    <input type="radio" id="radioGenderP" value="P"
                    name="gender" disabled/>
                    <label for="radioGenderP">P</label>
                </div>
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Nomor Telepon</label>
                <input type="text" class="form-control" id="phone_number"
                    name="phone_number" disabled>
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Agama</label>
                    <input type="text" class="form-control" id="religion"
                    name="religion" disabled>
            </div>
            <a href="{{ route('biodatas.edit', Auth::user()->id) }}" class="mb-3 mx-3">
                <button type="button" class="btn btn-outline-primary btn-block font-weight-bolder">Edit Detail</button>
            </a>
        @else
            <div class="alert alert-danger m-3" role="alert">
                Anda belum mengisi data personal biodata
            </div>
            <a href="{{ route('biodatas.add') }}" class="mb-3 mx-3">
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
                        + "/api/biodata/"
                        + user_id,
                    headers: {
                        'Authorization': token,
                        },
                }).then((res) => {
                    if (res.data.success){
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
        });
    </script>
@stop
