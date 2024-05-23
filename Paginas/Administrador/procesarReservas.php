<?php
require_once '../../config/validacion_session.php'; 
require_once '../../config/conexion.php'; 


if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id']) && isset($_GET['accion'])) {
    
    $reserva_id = $_GET['id'];
    $accion = $_GET['accion'];

    if ($accion === 'aceptar' || $accion === 'rechazar') {
        $nuevo_estado = ($accion === 'aceptar') ? 'Aceptado' : 'Rechazado';

        $sqlActualizarReserva = "UPDATE reserva SET ESTADO = ? WHERE ID_RESERVA = ?";
        $stmtActualizarReserva = $conexion->prepare($sqlActualizarReserva);
        $stmtActualizarReserva->bind_param("si", $nuevo_estado, $reserva_id);

        if ($stmtActualizarReserva->execute()) {
            echo "<script>
                    alert('Reserva " . $accion . " correctamente.');
                    window.location.href='solicitudesDeReservas.php'; // Redirigir a la página de solicitudes de reservas
                  </script>";
        } else {
            echo "Error al actualizar la reserva: " . $stmtActualizarReserva->error;
        }

        $stmtActualizarReserva->close();
    } else {
        echo "Acción no válida.";
    }
} else {
    echo "Método de solicitud no permitido o falta de parámetros.";
}

$conexion->close();
?>