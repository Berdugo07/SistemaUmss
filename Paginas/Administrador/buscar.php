<?php
// buscar.php
// Conexión a la base de datos
$host = "localhost";
$dbname = "reservasumss1"; 
$username = "root"; 
$password = ""; 

try {
    $conexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}

// Inicializamos la consulta con un WHERE verdadero
$query = "SELECT * FROM ambientes WHERE 1=1";
$params = [];

// Si se envió un valor de búsqueda desde el formulario, buscar en piso, estado o capacidad
if(isset($_GET['busqueda']) && $_GET['busqueda'] !== '') {
    $busqueda = $_GET['busqueda'];
    // Añadir condiciones de búsqueda para piso, estado y capacidad
    $query .= " AND (piso LIKE ? OR estado LIKE ? OR capacidad LIKE ?)";
    $params[] = "%$busqueda%";
    $params[] = "%$busqueda%";
    $params[] = "%$busqueda%";
}

// Preparamos la consulta
$stmt = $conexion->prepare($query);

// Ejecutamos la consulta con los parámetros
$stmt->execute($params);

// Obtenemos los resultados
$ambientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($ambientes); // Devolver los resultados como JSON

?>