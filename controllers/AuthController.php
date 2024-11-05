<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require '../includes/db.php';

class AuthController {
    public function login($correo, $contrasena) {
        global $conexion;
        $sql = "SELECT * FROM Usuarios WHERE correo = :correo AND contrasena = :contrasena";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':contrasena', $contrasena);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            $_SESSION['usuario_id'] = $usuario['ID'];
           // $_SESSION['nombres'] = $usuario['NOMBRES'];
            return true;
        } else {
            return false;
        }
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: ../index.php');
        exit();
    }
}

// Manejar la acción de logout
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    $authController = new AuthController();
    $authController->logout();
}
?>
