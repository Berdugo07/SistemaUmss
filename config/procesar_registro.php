<?php
require_once('conexion.php');

// Verificar si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $ci = $_POST['ci']; // Obtener el valor del campo CI
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $materias = $_POST['materias'];
    $carrera = $_POST['carrera'];
    $rol_id = $_POST['rol'];

    // Verificar si el correo electrónico ya está registrado
    $query = "SELECT COUNT(*) AS count FROM usuario WHERE correo = '$correo'";
    $result = $conexion->query($query);
    $row = $result->fetch_assoc();
    if ($row['count'] > 0) {
        echo "El correo electrónico ya está registrado.";
        exit; // Detener la ejecución del script
    }

    // Insertar datos en la tabla usuarios
    $sql = "INSERT INTO usuario (nombre, apellido, ci, correo, contrasena, materias, carrera, id_rol) VALUES ('$nombre', '$apellido', '$ci', '$correo', '$contrasena', '$materias', '$carrera', '$id_rol')";
   
    if ($conexion->query($sql) === TRUE) {
        echo "Registro exitoso";
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }

    // Cerrar conexión a la base de datos
    $conexion->close();
}
?>

