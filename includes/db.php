<?php
// Configuración de la conexión a la base de datos
$host = 'localhost';  // Servidor de la base de datos
$port = '1521';       // Puerto donde corre Oracle
$sid = 'sidd';        // SID de Oracle
$username = 'system'; // Usuario de la base de datos
$password = '12345';  // Contraseña del usuario

try {
    // Crear la cadena de conexión para Oracle
    $conexion = new PDO("oci:dbname=//$host:$port/$sid", $username, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Conexión exitosa"; // Mensaje para verificar que la conexión fue exitosa
} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}
?>
