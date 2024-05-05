<?php
require_once('conexion.php');
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

$query = "SELECT u.id, u.correo , u.contrasena, u.nombre, r.nombre as rol FROM usuarios u LEFT JOIN roles r ON u.rol_id = r.id WHERE correo = '$correo' AND contrasena = '$contrasena'";
$result = $conexion->query($query);
$row = $result->fetch_assoc();

if ($result->num_rows > 0) {
    session_start();
    $_SESSION['user'] = $correo;
    $_SESSION['rol'] = $row['rol'];
    

    // Redireccionar según el rol del usuario
    if ($row['rol'] == 'administrador') {
        header("Location:../Paginas/Administrador/HomeA.php");
    } elseif ($row['rol'] == 'docente') {
        header("Location:../Paginas/Usuario/HomeU.php");
    } else {
        // Redirigir a una página predeterminada en caso de que el rol no esté definido
        header("Location:../Paginas/Usuario/HomeU.php");
    }
} else {
    header("location: ../index.php?error=cuenta_no_existe");
}
