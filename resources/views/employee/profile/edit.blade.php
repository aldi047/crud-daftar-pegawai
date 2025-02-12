@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
<div class="card mt-3">
    <div class="card-header bg-primary">
        <div class="card-title">
            <h5 class="mb-0">Employee Profile</h5>
        </div>
    </div>
    <div class="card-body pb-0 px-3">
        <form id="update_user">
            <div class="card-body p-0">
                @csrf
                <div class="form-group">
                    <label class="font-weight-bold">Name</label>
                    <input type="text" class="form-control"
                        name="name" value="{{ old('name', Auth::user()->name) }}">

                    <!-- error message name-->
                    @error('name')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Email</label>
                    <input type="text" class="form-control"
                        name="email" value="{{ Auth::user()->email}}" disabled>

                    <!-- error message email -->
                    @error('email')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Photo</label>
                    <input type="file" class="form-control p-1" name="photo">

                    <!-- error message photo -->
                    @error('photo')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-outline-success btn-block font-weight-bolder mb-3">Simpan Perubahan</button>
        </form>
    </div>
</div>
@stop

@section('js')
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            const form = document.getElementById('update_user');
            var user_id = {{ Auth::user()->id }};
            var token = localStorage.getItem("crud_employee_token");
            form.addEventListener("submit", (e) => {
                e.preventDefault();

                var formData = new FormData(form);

                axios({
                    method: "post",
                    url: location.origin
                        + "/api/profile/"
                        + user_id
                        + "/edit",
                    data: formData,
                    headers: {
                        'Authorization': token,
                        'Content-Type': 'multipart/form-data'
                        },
                    params: {
                        _method:'PUT'
                    }
                }).then((res) => {
                    if (res.data.success){
                        let msg = res.data.message;
                        window.location.href = "/redirectWith?route=profiles&msg=" + msg;
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
