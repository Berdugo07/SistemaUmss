<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../../config/validacion_session.php');
include('../../config/conexion.php');

// Recibir los parámetros de la solicitud AJAX
$busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';
$orden = isset($_GET['orden']) ? $_GET['orden'] : 'desc';
$fecha = isset($_GET['fecha']) ? $_GET['fecha'] : '';
$filtroEstado = isset($_GET['filtroEstado']) ? $_GET['filtroEstado'] : '';

// Consulta SQL base
$sql = "SELECT r.ID_RESERVA, r.FECHA_RESERVA, a.NOMBRE AS nombre_ambiente, a.CAPACIDAD, u.NOMBRE AS nombre_usuario, h.HORA, r.ESTADO, m.NOMBRE AS nombre_materia
        FROM reserva r
        LEFT JOIN ambiente a ON r.ID_AMBIENTE = a.ID_AMBIENTE
        LEFT JOIN realiza rel ON r.ID_RESERVA = rel.ID_RESERVA
        LEFT JOIN usuario u ON rel.ID_USUARIO = u.ID_USUARIO
        LEFT JOIN horario h ON r.ID_HORARIO = h.ID_HORARIO
        LEFT JOIN materia m ON r.ID_MATERIA = m.ID_MATERIA
        WHERE 1";

// Filtros
$filters = [];
$params = [];
$types = '';

if (!empty($busqueda)) {
    if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $busqueda)) {
        $filters[] = "r.FECHA_RESERVA = ?";
        $params[] = $busqueda;
        $types .= 's';
    } elseif (is_numeric($busqueda)) {
        $filters[] = "a.ESTADO >= ?";
        $params[] = $busqueda;
        $types .= 'i';
    } else {
        $likeTerm = '%' . strtolower($busqueda) . '%';
        $filters[] = "(LOWER(a.NOMBRE) LIKE ? OR LOWER(u.NOMBRE) LIKE ? OR LOWER(m.NOMBRE) LIKE ? OR LOWER(r.ESTADO) LIKE ?)";
        $params = array_merge($params, [$likeTerm, $likeTerm, $likeTerm, $likeTerm]);
        $types .= 'ssss';
    }
}

if (!empty($fecha)) {
    if ($fecha == 'hoy') {
        $filters[] = "DATE(r.FECHA_RESERVA) = CURDATE()";
    } elseif ($fecha == 'semana') {
        $filters[] = "r.FECHA_RESERVA >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK)";
    }
}

if (!empty($filtroEstado)) {
    $filters[] = "r.ESTADO = ?";
    $params[] = $filtroEstado;
    $types .= 's';
}

if (!empty($filters)) {
    $sql .= ' AND ' . implode(' AND ', $filters);
}

$sql .= " ORDER BY r.FECHA_RESERVA " . ($orden === 'asc' ? 'ASC' : 'DESC');

$stmt = $conexion->prepare($sql);
if ($types) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado && $resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($fila['FECHA_RESERVA']) . "</td>
                <td>" . htmlspecialchars($fila['nombre_ambiente']) . "</td>
                <td>" . htmlspecialchars($fila['CAPACIDAD']) . "</td>
                <td>" . htmlspecialchars($fila['HORA']) . "</td>
                <td>" . htmlspecialchars($fila['nombre_usuario']) . "</td>
                <td>" . htmlspecialchars($fila['nombre_materia']) . "</td>
                <td>" . htmlspecialchars($fila['ESTADO']) . "</td>
                <td>
                    <a href='procesarReservas.php?id=" . $fila['ID_RESERVA'] . "&accion=aceptar' class='btn btn-primary'>Aceptar</a>
                    <a href='procesarReservas.php?id=" . $fila['ID_RESERVA'] . "&accion=rechazar' class='btn btn-danger'>Cancelar</a>
                </td>
                <td>
                    <a href='verificarReserva.php?id=" . $fila['ID_RESERVA'] . "&accion=rechazar' class='btn btn-success' style='display: block; width: 100px;'>
                        Visualizar<br> Solicitud
                    </a>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='9'>No hay solicitudes de reservas.</td></tr>";
}

$stmt->close();
$conexion->close();
?>
