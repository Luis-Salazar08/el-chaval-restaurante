<?php
// 1. Conectar a la base de datos
require_once '../backend/conexion.php';

// 2. Verificar que recibimos un ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // 3. Eliminar el plato de la base de datos
    $sql = "DELETE FROM platos WHERE id = $id";
    $conn->query($sql);
}

// 4. Cerrar conexión y regresar inmediatamente al panel
$conn->close();
header("Location: index.php");
exit();
?>