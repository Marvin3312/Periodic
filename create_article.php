<?php
session_start();
require './includes/db.php'; // Asegúrate de que la ruta sea correcta

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../views/login.php'); // Redirigir a la página de login si no está logueado
    exit();
}

$error = ''; // Variable para almacenar mensajes de error

// Obtener las categorías desde la base de datos
$sqlCategorias = "SELECT * FROM Categorias";
$stmtCategorias = $conexion->prepare($sqlCategorias);
$stmtCategorias->execute();
$categorias = $stmtCategorias->fetchAll(PDO::FETCH_ASSOC);

// Procesar el formulario si se envía
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $contenido = $_POST['contenido'];
    $imagenes = null;
    $estado_id = null;
    $usuario_id = null; 
    $categoria_id = $_POST['categoria_id'];

    // Depuración: Verificar los valores antes de la inserción
    var_dump($titulo, $contenido, $imagenes, $estado_id, $usuario_id, $categoria_id);

    // Consulta para insertar un nuevo artículo
    $sql = "INSERT INTO Articulos (titulo, contenido, imagenes, estado_id, usuario_id, categoria_id) VALUES (:titulo, :contenido, :imagenes, :estado_id, :usuario_id, :categoria_id)";
    
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':contenido', $contenido);
    $stmt->bindParam(':imagenes', $imagenes);
    $stmt->bindParam(':estado_id', $estado_id);
    $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
    $stmt->bindParam(':categoria_id', $categoria_id, PDO::PARAM_INT);
    
    try {
        $stmt->execute();
        // Redirigir a la página principal
        header('Location: http://localhost:800/prensa%20libre%20/');
        exit();
    } catch (PDOException $e) {
        // Mensaje de error en caso de fallo en la inserción
        $error = "Error al crear el artículo: " . $e->getMessage();
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
            <label for="categoria_id">Categoría:</label>
            <select class="form-control" name="categoria_id" required>
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?php echo $categoria['ID']; ?>"><?php echo $categoria['NOMBRE']; ?></option>
                <?php endforeach; ?>
            </select>
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
