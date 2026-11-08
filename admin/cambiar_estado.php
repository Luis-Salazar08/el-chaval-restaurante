<?php
// 1. Conectar a la base de datos
require_once '../backend/conexion.php';

// 2. Verificar que recibimos un ID y el estado actual del plato
if (isset($_GET['id']) && isset($_GET['estado'])) {
    $id = $_GET['id'];
    $estado_actual = $_GET['estado'];
    
    // 3. Decidir el nuevo estado (Si estaba disponible pasa a agotado, y viceversa)
    if ($estado_actual == 'disponible') {
        $nuevo_estado = 'agotado';
    } else {
        $nuevo_estado = 'disponible';
    }

    // 4. Actualizar la base de datos
    $sql = "UPDATE platos SET estado = '$nuevo_estado' WHERE id = $id";
    $conn->query($sql);
}

// 5. Cerrar conexión y regresar inmediatamente al panel
$conn->close();
header("Location: index.php");
exit();
?>