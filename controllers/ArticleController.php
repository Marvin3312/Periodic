<?php
require_once __DIR__ . '/../includes/db.php';

class ArticleController {
    public function getAllArticles() {
        global $conexion; // Asegúrate de que $conexion esté configurado para Oracle

        // Consulta para obtener todos los artículos
        $sql = "SELECT * FROM Articulos";
        
        // Preparar y ejecutar la consulta
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        
        // Recuperar todos los resultados en un array asociativo
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Verificar si se encontraron artículos
        if (empty($result)) {
            echo "No se encontraron artículos.";
            return [];
        }
        
        return $result;
    }
    
    public function createArticle($titulo, $contenido, $usuario_id, $categoria_id) {
        global $conexion; // Asegúrate de que $conexion esté configurado para Oracle

        // Consulta para insertar un nuevo artículo
        $sql = "INSERT INTO Articulos (titulo, contenido, usuario_id, categoria_id) VALUES (:titulo, :contenido, :usuario_id, :categoria_id)";
        
        // Preparar la consulta
        $stmt = $conexion->prepare($sql);
        
        // Vincular los parámetros
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':contenido', $contenido);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':categoria_id', $categoria_id);
        
        // Ejecutar la consulta y devolver el resultado
        return $stmt->execute();
    }
}
?>
