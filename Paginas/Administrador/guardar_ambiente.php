<?php
require_once '../../config/conexion.php';


if(isset($_FILES["imgAmbiente"]) && $_FILES["imgAmbiente"]["error"] === 0){
  
    $nombre = $_POST['nombre'];
    $capacidad = $_POST['capacidad'];
    $ubicacion = $_POST['ubicacion'];
    $periodo = $_POST['periodo'];
    $fechaInicio = $_POST['fechaInicio'];
    $fechaFin = $_POST['fechaFin'];
    $horario = $_POST['horario'];

    $imgAmbiente = $_FILES["imgAmbiente"];
    $nameImagen = $imgAmbiente["name"];
    $tmpImagen = $imgAmbiente["tmp_name"];

   
    move_uploaded_file($tmpImagen, "../../Img/Ambientes/" . $nameImagen);

    
    mysqli_query($conexion,"INSERT INTO ambientes (nombre, capacidad, ubicacion, periodo, fechaInicio, fechaFin, horario, imgAmbiente) 
        VALUES ('$nombre', '$capacidad', '$ubicacion', '$periodo', '$fechaInicio', '$fechaFin', '$horario', '$nameImagen')");

  
    mysqli_close($conexion);

 
    header("location:RegistrodeAmbiente.php");
} 
