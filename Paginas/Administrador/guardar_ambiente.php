<?php
require_once '../../config/validacion_session.php';
require_once '../../config/conexion.php';

// Verificar si el formulario se ha enviado mediante el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar la conexión a la base de datos
    $conn = new mysqli("localhost", "root", "", "ProyectoTIS");
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Obtener los datos del formulario y convertirlos a mayúsculas
    $nombre = isset($_POST['nombre']) ? strtoupper($_POST['nombre']) : '';
    $capacidad = isset($_POST['capacidad']) ? strtoupper($_POST['capacidad']) : '';
    $ubicacion = isset($_POST['ubicacion']) ? strtoupper($_POST['ubicacion']) : '';
    $piso = isset($_POST['piso']) ? strtoupper($_POST['piso']) : '';
    $tipo = isset($_POST['tipo']) ? strtoupper($_POST['tipo']) : '';
    $estado = isset($_POST['estado']) ? strtoupper($_POST['estado']) : 'HABILITADO';

    $img_Ambiente = '';
    // Verificar si se subió correctamente el archivo de imagen
    if (!empty($_FILES["img_Ambiente"]) && $_FILES["img_Ambiente"]["error"] === 0) {
        // Leer el contenido binario de la imagen
        $imgContenido = file_get_contents($_FILES["img_Ambiente"]["tmp_name"]);
        // Convertir el contenido binario a una cadena base64
        $imgBase64 = base64_encode($imgContenido);
        // Obtener la extensión del archivo de imagen
        $img_Ambiente = $_FILES["img_Ambiente"]["name"];
    }

    // Insertar los datos en la tabla 'ambiente'
    $sqlAmbiente = "INSERT INTO ambiente (nombre, capacidad, ubicacion, piso, tipo, img_Ambiente, estado)
                    VALUES ('$nombre', '$capacidad', '$ubicacion', '$piso','$tipo', '$img_Ambiente', '$estado')";

    if ($conn->query($sqlAmbiente) === TRUE) {
        echo "Registro insertado correctamente";
        // Redirigir al usuario después de la inserción exitosa
        header("Location: RegistrodeAmbiente.php?registro=exitoso");
        exit; // Terminar la ejecución del script después de la redirección
    } else {
        echo "Error al insertar datos: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
} else {
    echo "Error: el formulario no se ha enviado correctamente.";
}
?>

