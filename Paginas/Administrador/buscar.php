<?php
$host = "localhost";
$dbname = "proyectotis"; 
$username = "root"; 
$password = ""; 

try {
    $conexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}

$query = "SELECT * FROM AMBIENTE WHERE 1=1";
$params = [];

if(isset($_GET['busqueda']) && $_GET['busqueda'] !== '') {
    $busqueda = $_GET['busqueda'];
    $query .= " AND (NOMBRE LIKE ? OR ESTADO LIKE ? OR CAPACIDAD LIKE ?)";
    $params[] = "%$busqueda%";
    $params[] = "%$busqueda%";
    $params[] = "%$busqueda%";
}


$stmt = $conexion->prepare($query);

$stmt->execute($params);

$ambientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($ambientes); 

?>