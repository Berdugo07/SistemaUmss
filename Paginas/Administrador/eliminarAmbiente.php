
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Ambiente</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.3/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .confirmation-message {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #007bff;
            color: white;
            padding: 20px;
            border-radius: 10px;
            z-index: 9999;
        }
    </style>
</head>
<body>

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


if (!isset($_GET['id']) || empty($_GET['id'])) {
    exit();
}

$id = $_GET['id'];


$stmt = $conexion->prepare("SELECT * FROM ambientes WHERE id = :id");
$stmt->bindParam(":id", $id);
$stmt->execute();
$ambiente = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$ambiente) {
    echo "Ambiente no encontrado";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirmar_eliminar'])) {
    
    $stmt = $conexion->prepare("DELETE FROM ambientes WHERE id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    
    header("Location: listaDeAmbientesRegistrados.php");
    exit();
}
?>

<div class="confirmation-message">
    <h2>Eliminar Ambiente</h2>
    <p>¿Estás seguro de que deseas eliminar?</p>
    <form method="post">
        <button type="submit" name="confirmar_eliminar" class="btn btn-danger">Eliminar</button>
        <a href="listaDeAmbientesRegistrados.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.3/js/bootstrap.min.js"></script>

</body>
</html>
