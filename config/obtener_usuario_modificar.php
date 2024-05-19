<?php 

function obtener_nombre($ci_new){

    $query = "SELECT * FROM usuarios WHERE ci = '$ci_new' ";
    $conexion= new mysqli('localhost','root','','reservasumss1');
    $result = $conexion->query($query);
    
    $row = $result->fetch_assoc();
    $nombreUsuario = $row['nombre'];
    return $nombreUsuario;
}

function obtener_apellido($ci_new){
    $query = "SELECT * FROM usuarios WHERE ci= '$ci_new'";
    $conexion= new mysqli('localhost','root','','reservasumss1');
$result = $conexion->query($query);

$row = $result->fetch_assoc();
$apellidoUsuario = $row['apellido'];
return $apellidoUsuario;
}

function obtener_carrera($ci_new){
    $query = "SELECT * FROM usuarios WHERE ci = '$ci_new'";
    $conexion= new mysqli('localhost','root','','reservasumss1');
    $result = $conexion->query($query);
    
    $row = $result->fetch_assoc();
    $carreraUsuario = $row['carrera'];
    return $carreraUsuario;
}
function obtener_materia($ci_new){
    $query = "SELECT * FROM usuarios WHERE ci = '$ci_new'";
    $conexion= new mysqli('localhost','root','','reservasumss1');
    $result = $conexion->query($query);
    
    $row = $result->fetch_assoc();
    $materiaUsuario = $row['materias'];
    return $materiaUsuario;
}
?>