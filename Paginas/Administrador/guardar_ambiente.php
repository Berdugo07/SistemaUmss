<?php
require_once '../../config/validacion_session.php';
require_once '../../config/conexion.php';
// Conexión a la base de datos (reemplaza los valores con los de tu servidor)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reservasumss1";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$capacidad = $_POST['capacidad'];
$ubicacion = $_POST['ubicacion'];
$piso = $_POST['piso'];
$periodo = $_POST['periodo'];
$fechaInicio = $_POST['fechaInicio'];
$fechaFin = $_POST['fechaFin'];
$horarios = implode(",", $_POST['horarios']); // Concatenar los horarios seleccionados en una cadena separada por comas



$imgAmbiente = $_FILES["imgAmbiente"];
$nameImagen = $imgAmbiente["name"];
$tmpImagen = $imgAmbiente["tmp_name"];

move_uploaded_file($tmpImagen, "../../Img/Ambientes/" . $nameImagen);

// Insertar los datos en la base de datos
$sql = "INSERT INTO ambientes (nombre, capacidad, ubicacion, piso, periodo, fechainicio, fechafin, horarios, imgAmbiente)
        VALUES ('$nombre', '$capacidad', '$ubicacion', '$piso', '$periodo', '$fechaInicio', '$fechaFin','$horarios', '$nameImagen')";

if (isset($_FILES["imgAmbiente"]) && $_FILES["imgAmbiente"]["error"] === 0); {
}

if ($conn->query($sql) === TRUE) {
    header("Location: RegistrodeAmbiente.php");; // Envía una respuesta al cliente indicando que la operación se completó con éxito
} else {
    echo "Erroral insertar datos: " . $sql . "<br>" . $conn->error;
}

// Cerrar la conexión
$conn->close();
