<?php
// buscar.php
// Conexión a la base de datos
$host = "localhost";
$dbname = "ProyectoTIS"; 
$username = "root"; 
$password = ""; 

try {
    $conexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}

// Inicializamos la consulta con un WHERE verdadero
$query = "SELECT * FROM ambiente WHERE 1=1";
$params = [];

if(isset($_GET['busqueda']) && $_GET['busqueda'] !== '') {
    $busqueda = $_GET['busqueda'];
    $query .= " AND (nombre LIKE ? OR estado LIKE ? OR capacidad LIKE ?)";
    $params[] = "%$busqueda%";
    $params[] = "%$busqueda%";
    $params[] = "%$busqueda%";
}


$stmt = $conexion->prepare($query);

$stmt->execute($params);

$ambiente = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($ambiente); 

?>