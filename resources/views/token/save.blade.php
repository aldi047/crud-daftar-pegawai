<script>
    if (typeof(Storage) !== "undefined") {
        var prefix = "Bearer ";
        var token = @json($token);
        var user_type = @json($user_type);
        localStorage.setItem("crud_employee_token", prefix.concat(token));
        if (user_type == 'admin'){
            window.location.href = "/dashboard"
        } else {
            window.location.href = "/profile"
        }
    } else {
        window.location.href = "/"
    }
</script>
