<?php
require_once('conexion.php');

// Verificar si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $ci = $_POST['ci'];
    $correo = $_POST['correo'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_BCRYPT); // Asegúrate de usar password_hash para mayor seguridad
    $rol_id = $_POST['rol'];

    // Verificar si el correo electrónico ya está registrado
    $query = $conexion->prepare("SELECT COUNT(*) AS count FROM USUARIO WHERE CORREO = ?");
    $query->bind_param("s", $correo);
    $query->execute();
    $result = $query->get_result();
    $row = $result->fetch_assoc();

    if ($row['count'] > 0) {
        echo "El correo electrónico ya está registrado.";
        exit; // Detener la ejecución del script
    }

    // Insertar datos en la tabla usuarios
    $sql = $conexion->prepare("INSERT INTO USUARIO (NOMBRE, APELLIDO, CI, CORREO, CONTRASENA, ID_ROL) VALUES (?, ?, ?, ?, ?, ?)");
    $sql->bind_param("sssssi", $nombre, $apellido, $ci, $correo, $contrasena, $rol_id);

    if ($sql->execute() === TRUE) {
        echo "Registro exitoso";
    } else {
        echo "Error: " . $sql->error;
    }

    // Cerrar la conexión a la base de datos
    $sql->close();
    $conexion->close();
}
?>
