<?php
require '../includes/db.php'; // Incluir la conexión a la base de datos

$error = ''; // Variable para almacenar mensajes de error

// Procesar el formulario si se envía
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    
    // Consulta para insertar un nuevo usuario
    $sql = "INSERT INTO Usuarios (nombres, apellidos, telefono, correo, contrasena) VALUES (:nombres, :apellidos, :telefono, :correo, :contrasena)";
    
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':nombres', $nombres);
    $stmt->bindParam(':apellidos', $apellidos);
    $stmt->bindParam(':telefono', $telefono);
    $stmt->bindParam(':correo', $correo);
    $stmt->bindParam(':contrasena', $contrasena); // Almacenar la contraseña sin encriptar
    
    if ($stmt->execute()) {
        // Redirigir o mostrar un mensaje de éxito
        header('Location: login.php'); // Redirigir a la página de inicio de sesión
        exit();
    } else {
        // Mensaje de error en caso de fallo en la inserción
        $error = "Error al registrar el usuario. Intenta nuevamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Registro de Usuario</h2>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="form-group">
            <label for="nombres">Nombres:</label>
            <input type="text" class="form-control" name="nombres" required>
        </div>
        <div class="form-group">
            <label for="apellidos">Apellidos:</label>
            <input type="text" class="form-control" name="apellidos" required>
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono:</label>
            <input type="text" class="form-control" name="telefono">
        </div>
        <div class="form-group">
            <label for="correo">Correo Electrónico:</label>
            <input type="email" class="form-control" name="correo" required>
        </div>
        <div class="form-group">
            <label for="contrasena">Contraseña:</label>
            <input type="password" class="form-control" name="contrasena" required>
        </div>
        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
</div>

<!-- Bootstrap JS (opcional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
