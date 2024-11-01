<?php
session_start();
require './includes/db.php'; // Incluir la conexión a la base de datos

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

$error = ''; // Variable para almacenar mensajes de error

// Procesar el formulario si se envía
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $contenido = $_POST['contenido'];
    $imagenes = $_POST['imagenes'];
    $estado_id = $_POST['estado_id'];
    $usuario_id = $_SESSION['usuario_id']; // Asumimos que el ID del usuario está almacenado en la sesión
    $categoria_id = $_POST['categoria_id'];

    // Consulta para insertar un nuevo artículo
    $sql = "INSERT INTO Articulos (titulo, contenido, imagenes, estado_id, usuario_id, categoria_id) VALUES (:titulo, :contenido, :imagenes, :estado_id, :usuario_id, :categoria_id)";
    
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':contenido', $contenido);
    $stmt->bindParam(':imagenes', $imagenes);
    $stmt->bindParam(':estado_id', $estado_id);
    $stmt->bindParam(':usuario_id', $usuario_id);
    $stmt->bindParam(':categoria_id', $categoria_id);
    
    if ($stmt->execute()) {
        // Redirigir o mostrar un mensaje de éxito
        header('Location: ../index.php'); // Redirigir a la página principal
        exit();
    } else {
        // Mensaje de error en caso de fallo en la inserción
        $error = "Error al crear el artículo. Intenta nuevamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Artículo</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Crear Artículo</h2>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="form-group">
            <label for="titulo">Título:</label>
            <input type="text" class="form-control" name="titulo" required>
        </div>
        <div class="form-group">
            <label for="contenido">Contenido:</label>
            <textarea class="form-control" name="contenido" required></textarea>
        </div>
        <div class="form-group">
            <label for="imagenes">Imágenes:</label>
            <textarea class="form-control" name="imagenes"></textarea>
        </div>
        <div class="form-group">
            <label for="estado_id">Estado ID:</label>
            <input type="number" class="form-control" name="estado_id" required>
        </div>
        <div class="form-group">
            <label for="categoria_id">Categoría ID:</label>
            <input type="number" class="form-control" name="categoria_id" required>
        </div>
        <button type="submit" class="btn btn-primary">Crear Artículo</button>
    </form>
</div>

<!-- Bootstrap JS (opcional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
