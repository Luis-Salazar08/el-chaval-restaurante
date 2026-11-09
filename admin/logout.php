<?php
session_start();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <script>
        sessionStorage.removeItem('admin_sesion_activa');
        window.location.href = 'login.php';
    </script>
</head>
<body>
</body>
</html>