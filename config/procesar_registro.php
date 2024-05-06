<?php
require_once('conexion.php');

// Verificar si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $materias = $_POST['materias'];
    $carrera = $_POST['carrera'];
    $rol_id = $_POST['rol'];

    // Insertar datos en la tabla usuarios
    $sql = "INSERT INTO usuarios (nombre, apellido, correo, contrasena, materias, carrera, rol_id) VALUES ('$nombre', '$apellido', '$correo', '$contrasena', '$materias', '$carrera', '$rol_id')";

    if ($conexion->query($sql) === TRUE) {
        echo "Registro exitoso";
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }

    // Cerrar conexión a la base de datos
    $conexion->close();
}
?>

