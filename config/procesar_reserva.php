<?php
require_once('conexion.php');

// Obtener datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   // Obtener los datos del formulario del Paso 3
   $nombre = $_POST['nombres'];
   $apellido = $_POST['apellidos'];
   $correo = $_POST['correo'];
   $tipoActividad = $_POST['tipoActividad'];
   $materia = $_POST['materia'];
   $grupo = $_POST['grupo'];
   //$nombreAmbiente = $_POST['nombreAmbiente'];
   //$capacidad = $_POST['capacidad'];
   $fecha = $_POST['fecha'];
   $hora = $_POST['horario'];

   // Preparar y ejecutar la consulta SQL para insertar los datos en la tabla reserva_ambiente
   //'$nombreAmbiente', $capacidad, ---nombreAmbiente, capacidad, 
   $sql = "INSERT INTO reservas (nombreDocente, correo, tipoActividad, materia, grupo, fecha, hora) VALUES ('$nombre $apellido', '$correo', '$tipoActividad', '$materia', '$grupo', '$fecha', '$hora')";

   if ($conexion->query($sql) === TRUE) {
       echo "Los datos se han guardado correctamente.";
   } else {
       echo "Error al guardar los datos: " . $conexion->error;
   }

   // Cerrar la conexión
   $conexion->close();

}
?>