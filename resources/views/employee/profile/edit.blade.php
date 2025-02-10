@extends('adminlte::page')

@section('title', 'Dashboard')
@section('content_header')
    <h1>Employee Profile</h1>
@stop

@section('content')
<div class="card mt-3">
    <div class="card-header bg-primary">
        <div class="card-title">
            <h5 class="mb-0">Employee Profile</h5>
        </div>
    </div>
    <div class="card-body pb-0 px-3">
        <form action="{{ route('profiles.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
            <div class="card-body pb-0 px-0">
                @csrf
                @method('PUT')
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
                    <label class="font-weight-bold">Nomor HP Dokter</label>
                    <input type="text" class="form-control"
                        name="no_hp" value="{{ Auth::user()->name }}" disabled>

                    <!-- error message untuk no_hp -->
                    @error('no_hp')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            <label class="font-weight-bold">Nomor HP Dokter</label>
            <input type="text" class="form-control"
                name="no_hp" value="{{ Auth::user()->name }}" disabled>

            <!-- error message untuk no_hp -->
            @error('no_hp')
                <div class="alert alert-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
        </div>
                </div>
            </div>
            <button type="submit" class="btn btn-outline-success btn-block font-weight-bolder mb-3">Simpan Perubahan</button>
        </form>
    </div>
    <button class="btn btn-outline-primary btn-block font-weight-bolder" onclick="enableInput()">Edit</button>

    {{-- <a href="{{ route('profiles.edit', Auth::user()->id) }}" class="mb-3 mx-3">
        <button type="button" class="btn btn-outline-primary btn-block font-weight-bolder">Edit Profil</button>
    </a> --}}
</div>
@stop

@section('adminlte_js')
    <script>
        function enableInput() {
        var input = document.getElementById("name");
        var select = document.getElementById("select");
        if(input && input.value){
        select.disabled = true;
        } else {
        select.disabled = false;
        }
    }
    </script>
@stop
