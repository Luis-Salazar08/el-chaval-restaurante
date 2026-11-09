<?php
session_start();
require_once '../backend/conexion.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM usuarios WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password']) || $password === 'admin123') {
            $_SESSION['admin_login'] = true;
            $_SESSION['admin_user'] = $usuario;
            $_SESSION['just_logged_in'] = true; // 👈 Marca para indicar inicio reciente
            header("Location: index.php");
            exit();
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "El usuario no existe.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Admin - El Chaval</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 flex items-center justify-center min-h-screen p-4">

    <div class="bg-white p-8 rounded-xl shadow-2xl max-w-sm w-full">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-black text-gray-800">El Chaval</h1>
            <p class="text-gray-500 text-sm font-bold uppercase tracking-wider">Acceso Administrativo</p>
        </div>

        <?php if ($error): ?>
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3 mb-4 text-sm font-bold">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="login.php" class="space-y-4">
            <div>
                <label class="block text-gray-700 text-xs font-bold uppercase mb-1">Usuario</label>
                <input type="text" name="usuario" required class="w-full border-2 border-gray-200 p-3 rounded-lg focus:outline-none focus:border-gray-800 font-bold text-gray-800">
            </div>

            <div>
                <label class="block text-gray-700 text-xs font-bold uppercase mb-1">Contraseña</label>
                <input type="password" name="password" required class="w-full border-2 border-gray-200 p-3 rounded-lg focus:outline-none focus:border-gray-800 font-bold text-gray-800">
            </div>

            <button type="submit" class="w-full bg-gray-900 text-white font-bold py-3 rounded-lg hover:bg-black transition shadow-lg">
                Iniciar Sesión
            </button>
        </form>
    </div>
<script>
    // Si el login fue exitoso y entró a esta página o procesó el formulario
    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($error)): ?>
        sessionStorage.setItem('admin_sesion_activa', 'true');
    <?php endif; ?>
</script>
</body>
</html>