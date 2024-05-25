<?php
$host = "localhost";
$dbname = "proyectotis3"; 
$username = "root"; 
$password = ""; 

try {
    $conexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}

$query = "SELECT * FROM ambiente WHERE 1=1";
$params = [];

if(isset($_GET['busqueda']) && $_GET['busqueda'] !== '') {
    $busqueda = $_GET['busqueda'];
    // Modificamos la consulta para que busque en los campos deseados
    $query .= " AND (NOMBRE LIKE :busqueda OR ESTADO LIKE :busqueda OR CAPACIDAD LIKE :busqueda)";
    $params['busqueda'] = "%$busqueda%";
}

$stmt = $conexion->prepare($query);
$stmt->execute($params);

$ambientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($ambientes); 
?>