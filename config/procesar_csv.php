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
                        // Insertar datos en la tabla usuarios
                        $nombre = $datos[0];
                        $apellido = $datos[1];
                        $ci = $datos[2];
                        $correo = $datos[3];
                        $contrasena = $datos[4];
                        $materias = $datos[5];
                        $carrera = $datos[6];
                        $rol_id = $datos[7];

                        // Verificar si el correo electrónico ya está registrado
                        $query = "SELECT COUNT(*) AS count FROM usuarios WHERE correo = '$correo'";
                        $result = $conexion->query($query);
                        $row = $result->fetch_assoc();
                        if ($row['count'] > 0) {
                            $errorMessages[] = "El correo electrónico $correo ya está registrado. La fila $fila no se procesó.";
                            continue; // Pasar a la siguiente iteración
                        }

                        // Insertar datos en la tabla usuarios
                        $sql = "INSERT INTO usuarios (nombre, apellido, ci, correo, contrasena, materias, carrera, rol_id) VALUES ('$nombre', '$apellido', '$ci', '$correo', '$contrasena', '$materias', '$carrera', '$rol_id')";

                        if ($conexion->query($sql) === TRUE) {
                            $successCount++;
                        } else {
                            $errorMessages[] = "Error al insertar datos de la fila $fila: " . $conexion->error;
                        }
                    }
                    $fila++;
                }
                fclose($gestor);
                $response['success'] = "Se registraron correctamente $successCount usuarios.";
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
