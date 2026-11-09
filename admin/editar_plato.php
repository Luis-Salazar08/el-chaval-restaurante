<?php
session_start();
if (!isset($_SESSION['admin_login']) || $_SESSION['admin_login'] !== true) {
    header("Location: login.php");
    exit();
}
?>

<?php
// 1. Conectar a la base de datos
require_once '../backend/conexion.php';

// 2. Si el usuario presionó el botón de "Guardar Cambios" (Llega por POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $id_categoria = $_POST['categoria'];

    $sql_update = "UPDATE platos SET nombre = '$nombre', id_categoria = $id_categoria WHERE id = $id";
    $conn->query($sql_update);
    
    // Regresar al panel principal
    header("Location: index.php");
    exit();
}

// 3. Si apenas entramos a la página a ver el plato (Llega por GET)
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM platos WHERE id = $id";
    $result = $conn->query($sql);
    $plato = $result->fetch_assoc();
} else {
    // Si alguien entra sin ID, lo regresamos al panel
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Plato - El Chaval</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans p-6">

    <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md mt-10">
        <h2 class="text-2xl font-black text-gray-800 mb-6 border-b pb-2">✏️ Editar Plato</h2>
        
        <form method="POST" action="editar_plato.php">
            <!-- ID oculto para saber qué plato estamos editando -->
            <input type="hidden" name="id" value="<?php echo $plato['id']; ?>">
            
            <div class="mb-5">
                <label class="block text-gray-700 font-bold mb-2">Nombre del Plato:</label>
                <!-- Se rellena automáticamente con el nombre actual -->
                <input type="text" name="nombre" value="<?php echo htmlspecialchars($plato['nombre']); ?>" class="w-full border-2 border-gray-300 p-3 rounded focus:outline-none focus:border-blue-500 font-bold text-gray-700" required>
            </div>

            <div class="mb-8">
                <label class="block text-gray-700 font-bold mb-2">Categoría:</label>
                <select name="categoria" class="w-full border-2 border-gray-300 p-3 rounded focus:outline-none focus:border-blue-500 font-bold text-gray-700">
                    <?php
                    // Cargar las categorías dinámicamente
                    $sql_cat = "SELECT * FROM categorias";
                    $res_cat = $conn->query($sql_cat);
                    while($cat = $res_cat->fetch_assoc()) {
                        // Marcar como "seleccionada" la categoría actual del plato
                        $seleccionado = ($cat['id'] == $plato['id_categoria']) ? "selected" : "";
                        echo "<option value='" . $cat['id'] . "' $seleccionado>" . $cat['nombre'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="flex justify-end gap-3">
                <a href="index.php" class="bg-gray-400 text-white px-5 py-2 rounded font-bold shadow hover:bg-gray-500">Cancelar</a>
                <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded font-bold shadow hover:bg-blue-700">Guardar Cambios</button>
            </div>
        </form>
    </div>

</body>
</html>