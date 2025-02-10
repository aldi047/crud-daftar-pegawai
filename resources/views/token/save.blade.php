<script>
    if (typeof(Storage) !== "undefined") {
        var prefix = "Bearer ";
        var token = @json($token);
        localStorage.setItem("crud_employee_token", prefix.concat(token));
        window.location.href = "/dashboard"
    } else {
        window.location.href = "/dashboard"
    }
</script>
