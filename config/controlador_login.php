<?php
require_once('conexion.php');

// Obtener datos del formulario
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

// Preparar la consulta SQL para evitar inyección SQL
$query = $conexion->prepare("SELECT u.ID_USUARIO, u.CORREO, u.CONTRASENA, u.NOMBRE, r.NOMBRE AS rol 
                             FROM USUARIO u 
                             LEFT JOIN ROL r ON u.ID_ROL = r.ID_ROL 
                             WHERE u.CORREO = ? AND u.CONTRASENA = ?");
$query->bind_param("ss", $correo, $contrasena);
$query->execute();
$result = $query->get_result();
$row = $result->fetch_assoc();

if ($result->num_rows > 0) {
    session_start();
    $_SESSION['user'] = $correo;
    $_SESSION['rol'] = $row['rol'];

    // Redireccionar según el rol del usuario
    if ($row['rol'] == 'administrador') {
        header("Location: ../Paginas/Administrador/HomeA.php");
    } elseif ($row['rol'] == 'docente') {
        header("Location: ../Paginas/Usuario/HomeU.php");
    } else {
        // Redirigir a una página predeterminada en caso de que el rol no esté definido
        header("Location: ../Paginas/Usuario/HomeU.php");
    }
} 

// Cerrar la conexión a la base de datos
$query->close();
$conexion->close();
?>
