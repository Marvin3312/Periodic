<?php
require_once __DIR__ . '/../controllers/ArticleController.php';

$articleController = new ArticleController();
$articulos = $articleController->getAllArticles();

// Imprimir los datos recuperados para depuración
//echo '<pre>';
//print_r($articulos);
//echo '</pre>';
//?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artículos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Artículos</h2>
    <div class="row">
        <?php foreach ($articulos as $articulo): ?>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($articulo['TITULO']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($articulo['CONTENIDO']); ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>
