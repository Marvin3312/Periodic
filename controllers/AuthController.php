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
            // Obtener el correo y la contraseña
            $correo = trim($_POST['correo']); // Cambiado a correo
            $contrasena = trim($_POST['contrasena']);

            // Consulta para verificar el usuario
            $sql = "SELECT * FROM Usuarios WHERE correo = :correo"; // Cambiado a 'correo'
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':correo', $correo); // Cambiado a 'correo'
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            // Depuración: mostrar el contenido del usuario
            // var_dump($usuario); // Agrega esto para depurar

            // Verificar si el usuario existe y si la contraseña es correcta
            if ($usuario && password_verify($contrasena, $usuario['contrasena'])) { // Cambiado a 'contrasena'
                // Guardar los datos del usuario en la sesión
                session_start();
                $_SESSION['usuario_id'] = $usuario['id']; // Cambiado a 'id'
                $_SESSION['nombres'] = $usuario['nombres']; // Cambiado a 'nombres'
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
