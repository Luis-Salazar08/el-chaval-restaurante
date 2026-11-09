<?php
session_start();
if (!isset($_SESSION['admin_login']) || $_SESSION['admin_login'] !== true) {
    header("Location: login.php");
    exit();
}
require_once '../backend/conexion.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - El Chaval</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

    <!-- Barra de navegación del Administrador -->
    <nav class="bg-gray-900 text-white p-4 shadow-md flex justify-between items-center">
    <h1 class="font-bold text-xl flex items-center gap-2">
        <span>👨‍🍳</span> Admin - El Chaval
    </h1>
    <div class="flex items-center gap-3">
        <a href="../frontend/index.php" target="_blank" class="bg-gray-700 hover:bg-gray-600 px-3 py-1.5 rounded text-xs font-bold transition">
            Ver Menú Público
        </a>
        <a href="logout.php" class="bg-red-600 hover:bg-red-700 px-3 py-1.5 rounded text-xs font-bold transition">
            Cerrar Sesión
        </a>
    </div>
</nav>

    <!-- Contenido Principal -->
    <main class="container mx-auto p-6 max-w-5xl">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-black text-gray-800">Gestión de Platos</h2>
            <a href="nuevo_plato.php" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700 font-bold text-sm font-sans block text-center">+ Nuevo Plato</a>
        </div>

        <!-- Tabla de Platos -->
        <div class="bg-white rounded-lg shadow overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-gray-700 uppercase text-sm">
                        <th class="p-4">ID</th>
                        <th class="p-4">Nombre del Plato</th>
                        <th class="p-4">Estado</th>
                        <th class="p-4 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600">
                    <?php
                    // Obtener todos los platos de la base de datos
                    $sql = "SELECT id, nombre, estado FROM platos ORDER BY id_categoria, nombre";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            // Colores de la etiqueta según el estado
                            $color_estado = ($row["estado"] == 'disponible') ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
                            
                            // Configurar el botón de agotar/activar
                            $texto_boton = ($row["estado"] == 'disponible') ? 'Agotar' : 'Activar';
                            $color_boton = ($row["estado"] == 'disponible') ? 'bg-orange-500 hover:bg-orange-600' : 'bg-green-500 hover:bg-green-600';
                            
                            echo '<tr class="border-b hover:bg-gray-50">';
                            echo '<td class="p-4 font-bold">' . $row["id"] . '</td>';
                            echo '<td class="p-4">' . htmlspecialchars($row["nombre"]) . '</td>';
                            echo '<td class="p-4"><span class="px-2 py-1 rounded text-xs font-bold uppercase ' . $color_estado . '">' . $row["estado"] . '</span></td>';
                            
                            // Contenedor de los 3 botones
                            echo '<td class="p-4 flex justify-center gap-2">';
                            
                            // 1. Botón de Cambiar Estado (El que ya funciona)
                            echo '<a href="cambiar_estado.php?id=' . $row["id"] . '&estado=' . $row["estado"] . '" class="' . $color_boton . ' text-white px-2 py-1 rounded text-xs font-bold shadow transition">' . $texto_boton . '</a>';
                            
                            // 2. Botón Editar (Ahora apunta al nuevo formulario)
                            echo '<a href="editar_plato.php?id=' . $row["id"] . '" class="bg-yellow-400 text-yellow-900 px-2 py-1 rounded text-xs font-bold shadow hover:bg-yellow-500 transition">Editar</a>';
                            
                            // 3. Botón Borrar (Ahora funcional y con alerta de confirmación)
                            echo '<a href="borrar_plato.php?id=' . $row["id"] . '" onclick="return confirm(\'¿Estás seguro de que deseas eliminar este plato para siempre?\')" class="bg-red-500 text-white px-2 py-1 rounded text-xs font-bold shadow hover:bg-red-600 transition">Borrar</a>';
                            
                            echo '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="4" class="p-4 text-center">No hay platos registrados.</td></tr>';
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>