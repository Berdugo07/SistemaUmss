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
$fecha = $_POST['fecha'];
$tipo = $_POST["tipo"];
$imgAmbiente = $_FILES["imgAmbiente"];

move_uploaded_file($tmpImagen, "../../Img/Ambientes/" . $nameImagen);
$sql = "INSERT INTO ambientes (nombre) VALUES ('Ambiente de prueba')";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si el campo "tipo" está presente en el formulario
    if (isset($_POST["tipo"])) {
        // Accede al valor del campo "tipo"
        $tipo = $_POST["tipo"];

        // Aquí puedes realizar las operaciones necesarias con el valor de "tipo"

        // Por ejemplo, puedes imprimirlo para verificar su valor
        echo "Tipo seleccionado: " . $tipo;

        // Luego puedes continuar con el proceso de guardado en la base de datos u otras operaciones
    } else {
        // Si el campo "tipo" no está presente en el formulario, muestra un mensaje de error o realiza alguna acción adecuada
        echo "Error: el campo 'tipo' no está presente en el formulario.";
    }
} else {
    // Si el formulario no se ha enviado mediante el método POST, muestra un mensaje de error o realiza alguna acción adecuada
    echo "Error: el formulario no se ha enviado correctamente.";
}
if ($conn->query($sql) === TRUE) {
    echo "Registro insertado correctamente";
} else {
// Insertar los datos en la base de datos
$sql = "INSERT INTO ambientes ( 'nombre ',  'capacidad ',  'ubicacion ',  'piso ',  'fecha ',  'tipo ',  'imgAmbiente ')
        VALUES ('$nombre', '$capacidad', '$ubicacion', '$piso', '$fecha', '$tipo','$nameImagen')";

if (isset($_FILES["imgAmbiente"]) && $_FILES["imgAmbiente"]["error"] === 0); {
}

if ($conn->query($sql) === TRUE) {
    header("Location: RegistrodeAmbiente.php");; // Envía una respuesta al cliente indicando que la operación se completó con éxito
} else {
    echo "Erroral insertar datos: " . $sql . "<br>" . $conn->error;
}

// Cerrar la conexión
$conn->close();
}
