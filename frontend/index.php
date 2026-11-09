<?php
// 1. Conectar a la base de datos
require_once '../backend/conexion.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú - El Chaval Restaurant</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'chaval-crema': '#fefae0',
                        'chaval-naranja': '#e76f51',
                        'chaval-rojo': '#d62828',
                        'chaval-oscuro': '#1d3557'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-chaval-crema text-chaval-oscuro font-sans antialiased pb-10">

    <!-- Encabezado / Logo Mobile-First -->
    <header class="bg-white shadow-md p-6 text-center rounded-b-3xl mb-6">
        <h1 class="text-5xl font-extrabold tracking-tighter text-black">
            el <span class="text-chaval-naranja">Chaval</span>
        </h1>
        <p class="text-chaval-rojo font-bold text-sm tracking-widest uppercase mt-1">Restaurant</p>
        
        <div class="mt-4 inline-flex items-center gap-2 bg-black text-white px-5 py-2 rounded-full font-bold shadow-sm text-lg">
            <span>🛵</span> Delivery: 975 455 427
        </div>
    </header>

    <!-- Contenedor principal del Menú -->
    <main class="max-w-md mx-auto p-4">
        <h2 class="text-3xl font-black text-center mb-8 border-b-4 border-chaval-naranja pb-2">MENÚ DEL DÍA</h2>
        
        <?php
        // 2. Pedir a la base de datos todas las categorías (Entradas y Segundos)
        $sql_categorias = "SELECT * FROM categorias";
        $result_categorias = $conn->query($sql_categorias);

        if ($result_categorias->num_rows > 0) {
            // Por cada categoría encontrada, crear una sección
            while($categoria = $result_categorias->fetch_assoc()) {
                echo '<div class="mb-10">';
                
                // Título de la categoría (Diseño naranja como en los flyers)
                echo '<div class="bg-chaval-naranja text-white text-xl font-black py-2 px-5 rounded-lg mb-4 shadow-md inline-block uppercase tracking-wider">';
                echo $categoria["nombre"] . ':';
                echo '</div>';
                
                echo '<ul class="space-y-3 pl-2">';
                
                // 3. Pedir a la base de datos los platos que pertenezcan a esta categoría
                $id_cat = $categoria["id"];
                $sql_platos = "SELECT nombre FROM platos WHERE id_categoria = $id_cat AND estado = 'disponible'";
                $result_platos = $conn->query($sql_platos);
                
                if ($result_platos->num_rows > 0) {
                    // Imprimir cada plato
                    while($plato = $result_platos->fetch_assoc()) {
                        echo '<li class="bg-white p-3 rounded-lg shadow-sm border-l-4 border-chaval-rojo flex items-center justify-between">';
                        echo '<span class="font-bold text-gray-800 uppercase text-sm"> • ' . htmlspecialchars($plato["nombre"]) . '</span>';
                        echo '</li>';
                    }
                } else {
                    echo '<li class="text-gray-500 italic">No hay platos disponibles.</li>';
                }
                
                echo '</ul>';
                echo '</div>';
            }
        } else {
            echo '<p class="text-center text-red-500">No hay menú configurado hoy.</p>';
        }

        // Cerrar conexión
        $conn->close();
        ?>
    </main>
<!-- Pie de página con acceso para el Admin -->
    <footer class="text-center py-6 border-t border-amber-200/60 mt-10">
        <p class="text-xs text-gray-500 font-medium mb-2">© El Chaval Restaurant - Todos los derechos reservados</p>
        <a href="../admin/index.php" class="inline-flex items-center gap-1 text-xs text-gray-400 hover:text-chaval-oscuro transition font-bold underline">
            <span>🔒</span> Acceso Personal / Admin
        </a>
    </footer>
</body>
</html>