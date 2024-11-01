


<?php
session_start();

require 'includes/header.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    
    <?php if (isset($_SESSION['usuario'])): ?>
        <a href="create_article.php" class="btn btn-primary">Crear Artículo</a>
    <?php else: ?>
        <a href="login.php" class="btn btn-secondary">Iniciar Sesión</a>
    <?php endif; ?>
</div>
</body>
</html>
<?php
require 'views/articles.php';
require 'includes/footer.php';
?>

