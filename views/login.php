<?php
session_start();
require '../controllers/AuthController.php'; // Asegúrate de que esta ruta sea correcta
require '../includes/db.php'; // Incluir la conexión a la base de datos

$error = ''; // Variable para almacenar mensajes de error

// Crear una instancia de AuthController
$authController = new AuthController();
$error = $authController->login();

// Procesar el formulario si se envía
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_usuario = $_POST['nombre_usuario'];
    $contrasena = $_POST['contrasena'];

    // Consulta para verificar el usuario
    $sql = "SELECT * FROM Usuarios WHERE nombres = :nombre_usuario AND contrasena = :contrasena";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':nombre_usuario', $nombre_usuario);
    $stmt->bindParam(':contrasena', $contrasena);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        // Guardar los datos del usuario en la sesión
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['nombres'] = $usuario['nombres'];
        header('Location: welcom.php'); // Redirigir a la página de bienvenida
        exit();
    } else {
        // Mensaje de error en caso de credenciales incorrectas
        $error = "Credenciales incorrectas. Por favor, inténtalo de nuevo.";
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styles.css"> <!-- Archivo CSS personalizado -->
</head>
<body>

<div class="container mt-5">
    <h2>Inicio de Sesión</h2>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="form-group">
            <label for="nombre_usuario">Nombre de Usuario:</label>
            <input type="text" class="form-control" name="nombre_usuario" required>
        </div>
        <div class="form-group">
            <label for="contrasena">Contraseña:</label>
            <input type="password" class="form-control" name="contrasena" required>
        </div>
        <button type="submit" class="btn btn-primary">Ingresar</button>
    </form>

    <div class="mt-3">
        <p>¿No tienes una cuenta? <a href="register.php" class="btn btn-link">Regístrate aquí</a></p>
    </div>
</div>

<!-- Bootstrap JS (opcional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>