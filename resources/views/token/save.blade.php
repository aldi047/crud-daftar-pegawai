<script>
    if (typeof(Storage) !== "undefined") {
        var prefix = "Bearer ";
        var token = @json($token);
        localStorage.setItem("crud_employee_token", prefix.concat(token));
        window.location.href = "/home"
    } else {
        window.location.href = "/home"
    }
</script>
