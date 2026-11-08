<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú - El Chaval Restaurant</title>
    <!-- Cargamos Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Configuramos la paleta de colores de tu logo -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'chaval-crema': '#fefae0', /* Fondo inspirado en el logo */
                        'chaval-naranja': '#e76f51', /* Naranja de la etiqueta ENTRADAS */
                        'chaval-rojo': '#d62828', /* Rojo de la palabra RESTAURANT */
                        'chaval-oscuro': '#1d3557' /* Texto principal */
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-chaval-crema text-chaval-oscuro font-sans antialiased">

    <!-- Encabezado / Logo Mobile-First -->
    <header class="bg-white shadow-md p-6 text-center rounded-b-3xl mb-6">
        <h1 class="text-5xl font-extrabold tracking-tighter text-black">
            el <span class="text-chaval-naranja">Chaval</span>
        </h1>
        <p class="text-chaval-rojo font-bold text-sm tracking-widest uppercase mt-1">Restaurant</p>
        
        <!-- Botón de Delivery -->
        <div class="mt-4 inline-flex items-center gap-2 bg-black text-white px-5 py-2 rounded-full font-bold shadow-sm text-lg">
            <span>🛵</span> Delivery: 975 455 427
        </div>
    </header>

    <!-- Contenedor principal del Menú -->
    <main class="max-w-md mx-auto p-4">
        <h2 class="text-3xl font-black text-center mb-6 border-b-4 border-chaval-naranja pb-2 inline-block w-full">MENÚ DEL DÍA</h2>
        
        <p class="text-center text-gray-600 mb-8">Aquí mostraremos los platos desde la base de datos...</p>
    </main>

</body>
</html>