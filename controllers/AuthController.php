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
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['nombres'] = $usuario['nombres'];
            $_SESSION['rol'] = $usuario['rol']; // Asumiendo que tienes un campo 'rol' en la tabla Usuarios
            return true;
        } else {
            return false;
        }
    }

    public function logout() {
        session_destroy();
        header('Location: ../index.php');
        exit();
    }
}
?>
