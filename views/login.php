<?php
require '../controllers/AuthController.php';
$authController = new AuthController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    if ($authController->login($correo, $contrasena)) {
        header('Location: ../index.php');
        exit();
    } else {
        $error = "Credenciales incorrectas.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Inicio de Sesión</h2>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <form action="" method="POST">
        <div class="form-group">
            <label for="correo">Correo:</label>
            <input type="email" class="form-control" name="correo" required>
        </div>
        <div class="form-group">
            <label for="contrasena">Contraseña:</label>
            <input type="password" class="form-control" name="contrasena" required>
        </div>
        <button type="submit" class="btn btn-primary">Ingresar</button>
    </form>
    <div class="mt-3">
        <a href="register.php" class="btn btn-secondary">Registrarse</a>
    </div>
</div>
</body>
</html>
