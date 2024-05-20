<?php
require_once('conexion.php');

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se recibió un archivo
    if (isset($_FILES['archivo_csv']) && $_FILES['archivo_csv']['error'] == UPLOAD_ERR_OK) {
        $nombreArchivo = $_FILES['archivo_csv']['name'];
        $rutaTemporal = $_FILES['archivo_csv']['tmp_name'];

        // Verificar si el archivo es un archivo CSV
        $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
        if ($extension != 'csv') {
            $response['error'] = "El archivo debe ser un archivo CSV.";
        } else {
            // Procesar el archivo CSV
            $fila = 1;
            $successCount = 0;
            $errorMessages = array();
            if (($gestor = fopen($rutaTemporal, "r")) !== FALSE) {
                while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
                    // Ignorar la primera fila si contiene encabezados
                    if ($fila > 1) {
                        // Insertar datos en la tabla ambientes
                        $nombre = $datos[1];
                        $capacidad = $datos[2];
                        $fecha = $datos[3];
                        $tipo = $datos[4];
                        $imagenAmbiente = $datos[5];
// Insertar los datos en la tabla ubicación 
$lugar = $datos[1];
$piso = $datos[2];
                        // Insertar datos en la tabla ambientes
                        $sql = "INSERT INTO ambiente (nombre, capacidad, fecha, tipo, imgAmbiente) VALUES ('$nombre', '$capacidad',  $fecha, '$tipo', '$imagenAmbiente')";
                        $sql = "INSERT INTO ubicación (lugar, piso) VALUES ('$lugar',  '$piso')";

                        if ($conexion->query($sql) === TRUE) {
                            $successCount++;
                        } else {
                            $errorMessages[] = "Error al insertar datos de la fila $fila: " . $conexion->error;
                        }
                    }
                    $fila++;
                }
                fclose($gestor);
                $response['success'] = "Se registrar on correctamente $successCount ambiente.";
                if (!empty($errorMessages)) {
                    $response['errors'] = $errorMessages;
                }
            } else {
                $response['error'] = "Error al abrir el archivo CSV.";
            }
        }
    } else {
        $response['error'] = "No se recibió ningún archivo o hubo un error al subirlo.";
    }
}

echo json_encode($response);
?>

              
