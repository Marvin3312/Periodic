<?php
class AuthController {
    private $conexion;

    public function __construct() {
        require '../includes/db.php'; // Asegúrate de que la ruta sea correcta
        $this->conexion = $conexion;
    }

    public function login() {
        $error = '';

        // Procesar el formulario si se envía
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre_usuario = $_POST['nombre_usuario'];
            $contrasena = $_POST['contrasena'];

            // Consulta para verificar el usuario
            $sql = "SELECT * FROM Usuarios WHERE nombres = :nombre_usuario";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':nombre_usuario', $nombre_usuario);
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verificar si el usuario existe y si la contraseña es correcta
            if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
                // Guardar los datos del usuario en la sesión
                session_start();
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['nombres'] = $usuario['nombres'];
                header('Location: welcome.php'); // Redirigir a la página de bienvenida
                exit();
            } else {
                // Mensaje de error en caso de credenciales incorrectas
                $error = "Credenciales incorrectas. Por favor, inténtalo de nuevo.";
            }
        }

        return $error; // Retornar el mensaje de error si existe
    }
}
?>
