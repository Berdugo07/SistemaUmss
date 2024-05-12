<?php
require_once '../../config/validacion_session.php';
require_once '../../config/conexion.php';

// Verificar si el formulario se ha enviado mediante el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar la conexión a la base de datos
    $conn = new mysqli("localhost", "root", "", "reservasumss1");
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $capacidad = $_POST['capacidad'];
    $ubicacion = $_POST['ubicacion'];
    $piso = $_POST['piso'];
    $fecha = $_POST['fecha'];
    $tipo = $_POST["tipo"];
    $imgAmbiente = $_FILES["imgAmbiente"];

    // Verificar si se subió correctamente el archivo de imagen
    if (isset($_FILES["imgAmbiente"]) && $_FILES["imgAmbiente"]["error"] === 0) {
        // Procesar la imagen si es necesario
        $nombreImagen = $_FILES["imgAmbiente"]["name"];
        move_uploaded_file($_FILES["imgAmbiente"]["tmp_name"], "../../Img/Ambientes/" . $nombreImagen);
    } else {
        echo "Error: no se pudo subir el archivo de imagen.";
        exit; // Terminar la ejecución del script si hay un error
    }

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO ambientes (nombre, capacidad, ubicacion, piso, fecha, tipo, imgAmbiente)
            VALUES ('$nombre', '$capacidad', '$ubicacion', '$piso', '$fecha', '$tipo', '$nombreImagen')";

    if ($conn->query($sql) === TRUE) {
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
    // Si el formulario no se ha enviado mediante el método POST, muestra un mensaje de error o realiza alguna acción adecuada
    echo "Error: el formulario no se ha enviado correctamente.";
}
?>
