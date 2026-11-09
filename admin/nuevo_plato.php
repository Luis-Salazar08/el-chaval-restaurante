<?php
// 1. Conectar a la base de datos
require_once '../backend/conexion.php';

// 2. Procesar el formulario al enviar (método POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $id_categoria = $_POST['categoria'];

    if (!empty($nombre) && !empty($id_categoria)) {
        // Insertar el nuevo plato (estado por defecto: disponible)
        $sql = "INSERT INTO platos (nombre, id_categoria, estado) VALUES ('$nombre', $id_categoria, 'disponible')";
        $conn->query($sql);
    }
    
    // Regresar al panel principal
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Plato - El Chaval</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans p-6">

    <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md mt-10">
        <h2 class="text-2xl font-black text-gray-800 mb-6 border-b pb-2">➕ Agregar Nuevo Plato</h2>
        
        <form method="POST" action="nuevo_plato.php">
            <div class="mb-5">
                <label class="block text-gray-700 font-bold mb-2">Nombre del Plato:</label>
                <input type="text" name="nombre" placeholder="Ej: Seco de cabrito" class="w-full border-2 border-gray-300 p-3 rounded focus:outline-none focus:border-blue-500 font-bold text-gray-700" required>
            </div>

            <div class="mb-8">
                <label class="block text-gray-700 font-bold mb-2">Categoría:</label>
                <select name="categoria" class="w-full border-2 border-gray-300 p-3 rounded focus:outline-none focus:border-blue-500 font-bold text-gray-700" required>
                    <option value="">Selecciona una categoría...</option>
                    <?php
                    // Cargar las categorías dinámicamente desde MySQL
                    $sql_cat = "SELECT * FROM categorias";
                    $res_cat = $conn->query($sql_cat);
                    while($cat = $res_cat->fetch_assoc()) {
                        echo "<option value='" . $cat['id'] . "'>" . $cat['nombre'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="flex justify-end gap-3">
                <a href="index.php" class="bg-gray-400 text-white px-5 py-2 rounded font-bold shadow hover:bg-gray-500">Cancelar</a>
                <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded font-bold shadow hover:bg-blue-700">Guardar Plato</button>
            </div>
        </form>
    </div>

</body>
</html>