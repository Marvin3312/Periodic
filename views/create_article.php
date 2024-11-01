<?php
session_start();
if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] != 'admin') {
    header('Location: login.php');
    exit();
}

require '../controllers/ArticleController.php';
$articleController = new ArticleController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $contenido = $_POST['contenido'];
    $usuario_id = $_SESSION['usuario_id'];
    $categoria_id = $_POST['categoria_id'];
    if ($articleController->createArticle($titulo, $contenido, $usuario_id, $categoria_id)) {
        header('Location: ../index.php');
        exit();
    } else {
        $error = "Error al crear el artículo.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Artículo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Crear Artículo</h2>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <form action="" method="POST">
        <div class="form-group">
            <label for="titulo">Título:</label>
            <input type="text" class="form-control" name="titulo" required>
        </div>
        <div class="form-group">
            <label for="contenido">Contenido:</label>
            <textarea class="form-control" name="contenido" rows="5" required></textarea>
        </div>
        <div class="