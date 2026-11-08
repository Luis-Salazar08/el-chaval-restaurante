<?php
// Credenciales por defecto de XAMPP
$host = "localhost";
$usuario = "root";
$contrasena = ""; 
$base_datos = "restaurante_chaval";

// Crear la conexión usando MySQLi (Orientado a objetos)
$conn = new mysqli($host, $usuario, $contrasena, $base_datos);

// Verificar si hay algún error en la conexión
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Puedes descomentar la siguiente línea temporalmente para probar si funciona
// echo "¡Conexión exitosa a la base de datos de El Chaval!";
?>