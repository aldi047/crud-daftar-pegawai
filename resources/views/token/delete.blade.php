@extends('adminlte::master')
@section('adminlte_js')
    <script>
        $(document).ready(function() {
            if (typeof(Storage) !== "undefined") {
            var token = localStorage.getItem("crud_employee_token");
            $.ajax({
                type:"GET",
                url:location.origin + "/api/removeToken",
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('Authorization', token);
                },
                success: function (data) {
                    console.log('Logout berhasil!');
                },
                error: function () {
                    console.log('Logout gagal!');
                }});
            localStorage.removeItem("crud_employee_token");
            window.location.href = "/"
        } else {
            window.location.href = "/home"
        }
        });
    </script>
@stop
