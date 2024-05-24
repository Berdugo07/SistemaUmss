<?php
require_once '../../config/validacion_session.php'; 
require_once '../../config/conexion.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id']) && isset($_GET['accion']) && !empty($_GET['id']) && !empty($_GET['accion'])) {
    
    $reserva_id = $_GET['id'];
    $accion = $_GET['accion'];

    if ($accion === 'aceptar' || $accion === 'rechazar') {
        // Obtener el estado actual de la reserva
        $query_estado_reserva = "SELECT ESTADO, ID_AMBIENTE, FECHA_RESERVA FROM reserva WHERE ID_RESERVA = ?";
        $stmt_estado_reserva = $conexion->prepare($query_estado_reserva);
        $stmt_estado_reserva->bind_param("i", $reserva_id);
        $stmt_estado_reserva->execute();
        $stmt_estado_reserva->bind_result($estado_reserva, $id_ambiente, $fecha_reserva);
        $stmt_estado_reserva->fetch();
        $stmt_estado_reserva->close();

        $estado_reserva = strtolower($estado_reserva);
        
        // Verificar si el estado actual es "Pendiente"
        if ($estado_reserva === 'pendiente') {
            // Verificar la capacidad del ambiente
            $query_capacidad_ambiente = "SELECT CAPACIDAD FROM ambiente WHERE ID_AMBIENTE = ?";
            $stmt_capacidad_ambiente = $conexion->prepare($query_capacidad_ambiente);
            $stmt_capacidad_ambiente->bind_param("i", $id_ambiente);
            $stmt_capacidad_ambiente->execute();
            $stmt_capacidad_ambiente->bind_result($capacidad_ambiente);
            $stmt_capacidad_ambiente->fetch();
            $stmt_capacidad_ambiente->close();

            // Verificar si hay reservas ya aceptadas para el mismo ambiente y fecha
            $query_reservas_aceptadas = "SELECT ID_RESERVA FROM reserva WHERE ID_AMBIENTE = ? AND FECHA_RESERVA = ? AND ESTADO = 'Aceptado'";
            $stmt_reservas_aceptadas = $conexion->prepare($query_reservas_aceptadas);
            $stmt_reservas_aceptadas->bind_param("is", $id_ambiente, $fecha_reserva);
            $stmt_reservas_aceptadas->execute();
            $stmt_reservas_aceptadas->store_result();

            // Si hay reservas aceptadas para el mismo ambiente y fecha, mostrar un mensaje de error
            if ($stmt_reservas_aceptadas->num_rows > 0) {
                echo "<script>
                        alert('No se puede aceptar la reserva porque ya existe una reserva aceptada para el mismo ambiente y fecha.');
                        window.history.back();
                      </script>";
                exit; // Salir del script
            }

            // Verificar si la capacidad es suficiente
            if ($capacidad_ambiente > 0) {
                // Cambiar el estado de la reserva según la acción
                $nuevo_estado = ($accion === 'aceptar') ? 'Aceptado' : 'Rechazado';

                // Actualizar el estado de la reserva en la base de datos
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
                // Si la capacidad no es suficiente, mostrar un mensaje de error
                echo "<script>
                        alert('No se puede aceptar la reserva porque la capacidad del ambiente no es suficiente.');
                        window.history.back();
                      </script>";
            }

            $stmt_reservas_aceptadas->close();
        } else {
            // Si el estado no es "Pendiente", mostrar un mensaje de error y redirigir al usuario
            echo "<script>
                    alert('No se puede " . $accion . " la reserva porque el estado actual no es Pendiente.');
                    window.location.href='solicitudesDeReservas.php'; // Redirigir a la página de solicitudes de reservas
                  </script>";
        }
    } else {
        echo "Acción no válida.";
    }
} else {
    echo "Método de solicitud no permitido o falta de parámetros.";
}

$conexion->close();
?>
