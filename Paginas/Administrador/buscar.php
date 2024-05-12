<?php
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

$query = "SELECT * FROM ambientes WHERE 1=1";
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

$ambientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($ambientes); 

?>