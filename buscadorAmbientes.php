
// ... conexión a la base de datos ...
<?php
    // Conexión a la base de datos
    $host = "localhost";
    $user = "root";
    $password = "";
    $db = "reservasumss1";

    $conexion = new mysqli($host, $user, $password, $db);

// Construir la consulta SQL con los filtros
$query = "SELECT * FROM ambientes WHERE 1=1";

if ($_POST["piso"] != 'Todos') {
    $query .= " AND piso = '" . $_POST["piso"] . "'";
}

if ($_POST["tipo"] != 'Todos') {
    $query .= " AND tipo = '" . $_POST["tipo"] . "'";
}

if ($_POST["capacidad"] != 'Todos') {
    $query .= " ORDER BY capacidad " . $_POST["capacidad"];
}

// Ejecutar la consulta
$result = $conexion->query($query);

// Mostrar los resultados
if ($result->num_rows > 0) {
    while ($fila = $result->fetch_assoc()) {
        // Mostrar los datos de cada fila
    }
} else {
    echo "No se encontraron ambientes que coincidan con los filtros seleccionados.";
}

// ... cierre de la conexión a la base de datos ...
$conexion->close();
?>