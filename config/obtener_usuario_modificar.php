<?php 

function obtener_nombre($ci_new){

    $query = "SELECT * FROM usuario WHERE ci = '$ci_new' ";
    $conexion= new mysqli('localhost','root','','ProyectoTIS');
    $result = $conexion->query($query);
    
    $row = $result->fetch_assoc();
    $nombreUsuario = $row['nombre'];
    return $nombreUsuario;
}

function obtener_apellido($ci_new){
    $query = "SELECT * FROM usuario WHERE ci= '$ci_new'";
    $conexion= new mysqli('localhost','root','','ProyectoTIS');
$result = $conexion->query($query);

$row = $result->fetch_assoc();
$apellidoUsuario = $row['apellido'];
return $apellidoUsuario;
}

function obtener_correo($ci_new){
    $query = "SELECT * FROM usuario WHERE ci = '$ci_new'";
    $conexion= new mysqli('localhost','root','','ProyectoTIS');
    $result = $conexion->query($query);
    
    $row = $result->fetch_assoc();
    $correoUsuario = $row['correo'];
    return $correoUsuario;
}
?>