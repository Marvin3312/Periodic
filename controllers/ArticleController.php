<?php
require '../includes/db.php';

class ArticleController {
    public function getAllArticles() {
        global $conexion;
        $sql = "SELECT * FROM Articulos";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createArticle($titulo, $contenido, $usuario_id, $categoria_id) {
        global $conexion;
        $sql = "INSERT INTO Articulos (titulo, contenido, usuario_id, categoria_id) VALUES (:titulo, :contenido, :usuario_id, :categoria_id)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':contenido', $contenido);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':categoria_id', $categoria_id);
        return $stmt->execute();
    }
}
?>
