@extends('adminlte::page')

@section('title', 'Profile')

@section('content')
<div class="card mt-3">
    <div class="card-header bg-primary">
        <div class="card-title">
            <h5 class="mb-0">Employee Profile</h5>
        </div>
    </div>
    <div class="card-body pb-0 px-3">
        <div class="form-group">
            <label class="font-weight-bold">Name</label>
            <input type="text" class="form-control"
                value="{{ Auth::user()->name }}" disabled>
        </div>
        <div class="form-group">
            <label class="font-weight-bold">Email</label>
            <input type="text" class="form-control"
                value="{{ Auth::user()->email }}" disabled>
        </div>
        <div class="form-group">
            <label class="font-weight-bold">Photo</label>
            <img
            @if (Auth::user()->photo_path)
                src="{{ url('/storage') . '/' .Auth::user()->photo_path }}"
            @else
                src="{{ asset('image/blank_profile.jpg') }}"
            @endif
            class="rounded" style="width: 200px">
        </div>
        <a href="{{ route('profiles.edit', Auth::user()->id) }}" class="mb-3 mx-3">
            <button type="button" class="btn btn-outline-primary btn-block font-weight-bolder">Edit Profil</button>
        </a>
        <button onclick="deleteProfile()" class="btn btn-outline-danger btn-block font-weight-bolder mb-3" >Delete Profile</button>
    </div>
</div>
@stop

@section('js')
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script>
        var user_id = {{ Auth::user()->id }};
        var token = localStorage.getItem("crud_employee_token");
        function deleteProfile(){
            axios({
                method: "delete",
                url: location.origin
                    + "/api/profile/"
                    + user_id
                    + "/delete",
                headers: {
                    'Authorization': token,
                    },
            }).then((res) => {
                if (res.data.success){
                    let msg = res.data.message;
                    window.location.href = "/redirectWith?route=welcome&msg=" + msg;
                }
            })
            .catch((err) => {
                console.log(err);
                let detail_message = JSON.stringify(err.response.data.content);
                toastr.error(detail_message, err.response.data.message);
            });
        }
    </script>
@stop
