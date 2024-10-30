<?php
// Configuración de la conexión a la base de datos
$host = 'localhost';  // Servidor de la base de datos
$port = '3307';       // Puerto donde corre MySQL
$dbname = 'proyectobda'; // Nombre de la base de datos
$username = 'root';   // Usuario de la base de datos
$password = '';       // Contraseña del usuario (ajusta si es necesario)

try {
    // La variable de conexión debe incluir el puerto
    $conexion = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}
?>
