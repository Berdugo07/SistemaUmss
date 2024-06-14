<?php
require_once '../../config/validacion_session.php';
require_once '../../config/conexion.php';

$correo = $_SESSION['user'];

$query = "SELECT nombre FROM usuario WHERE correo = '$correo'";
$result = $conexion->query($query);
if (!$result) {
    die("Error en la consulta del nombre de usuario: " . $conexion->error);
}
$row = $result->fetch_assoc();
$nombreUsuario = $row['nombre'];

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id']) && !empty($_GET['id'])) {
    
    $reserva_id = $_GET['id'];

    // Obtener los detalles de la reserva
    $query_detalle_reserva = "SELECT r.*, a.NOMBRE AS NOMBRE_AMBIENTE, a.PISO AS PISO_AMBIENTE
                              FROM reserva r
                              INNER JOIN ambiente a ON r.ID_AMBIENTE = a.ID_AMBIENTE
                              WHERE r.ID_RESERVA = ?";
    $stmt_detalle_reserva = $conexion->prepare($query_detalle_reserva);
    $stmt_detalle_reserva->bind_param("i", $reserva_id);
    $stmt_detalle_reserva->execute();
    $resultado_detalle_reserva = $stmt_detalle_reserva->get_result();
    $detalle_reserva = $resultado_detalle_reserva->fetch_assoc();
    $stmt_detalle_reserva->close();

    // Obtener los ambientes que cumplen con la capacidad requerida
    $query_ambientes_disponibles = "SELECT ID_AMBIENTE, NOMBRE, CAPACIDAD 
                                    FROM ambiente 
                                    WHERE CAPACIDAD >= ? AND ESTADO = 'Disponible'";
    $stmt_ambientes_disponibles = $conexion->prepare($query_ambientes_disponibles);
    $stmt_ambientes_disponibles->bind_param("i", $detalle_reserva['CAPACIDAD']);
    $stmt_ambientes_disponibles->execute();
    $resultado_ambientes_disponibles = $stmt_ambientes_disponibles->get_result();
    $ambientes_disponibles = $resultado_ambientes_disponibles->fetch_all(MYSQLI_ASSOC);
    $stmt_ambientes_disponibles->close();


    // Obtener sugerencias de ambientes en el mismo piso cuya suma de capacidades sea igual o menor a la capacidad requerida
    if (empty($ambientes_disponibles)) {
        $query_sugerencias_ambientes = "SELECT ID_AMBIENTE, NOMBRE, CAPACIDAD 
                                        FROM ambiente 
                                        WHERE PISO = ? AND ESTADO = 'Disponible'";
        $stmt_sugerencias_ambientes = $conexion->prepare($query_sugerencias_ambientes);
        $stmt_sugerencias_ambientes->bind_param("i", $detalle_reserva['PISO_AMBIENTE']);
        $stmt_sugerencias_ambientes->execute();
        $resultado_sugerencias_ambientes = $stmt_sugerencias_ambientes->get_result();
        $sugerencias_ambientes = $resultado_sugerencias_ambientes->fetch_all(MYSQLI_ASSOC);
        $stmt_sugerencias_ambientes->close();
    } else {
        $sugerencias_ambientes = [];
    }

    $conexion->close();
} else {
    echo "Falta el ID de la reserva.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VERIFICAR SOLICITUD</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="listaDeAmbientesRegistrados.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
<header class="headerHU">
    <div class="header-content">
        <div class="header-logo" style="margin-right: 20px;">
            <img src="../../Img/logoFCyT.jpeg" alt="Logo" width="180" height="65">
        </div>
        <div class="vertical-line" style="border-left: 1px solid white; height: 40px; margin-left: 20px;"></div>
        <span class="header-title" style="font-family: 'Courgette', cursive; color: white; margin-left: 60px;margin-right:100px;">SISTEMA DE RESERVA DE AULAS DE FCyT</span>
        <div class="vertical-line" style="border-left: 1px solid white; height: 40px; margin-left: 60px;"></div>
        <div class="header-links" style="display: flex; align-items: center;">
            <i class="bi bi-bell-fill" style="margin-left: 40px;"></i>
            <i class="bi bi-person-circle" style="margin-left: 50px;"></i>
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: white;margin-left:50px;">
                <?php echo $nombreUsuario; ?>
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="../../config/controlador_cerrar_sesion.php">Cerrar sesión</a></li>
            </ul>
        </div>
    </div>
</header>
<div class="wrapper">
    <aside id="sidebar">
        <div class="d-flex">
            <button id="toggle-btn" type="button">
                <i class="lni lni-menu"></i>
            </button>
        </div>
        <ul class="ul sidebar-nav">
            <li class="sidebar-item">
                <a href="HomeA.php" class="sidebar-link" style="text-decoration: none;">
                    <i class="bi bi-house-door-fill fs-4"></i>
                    <span>INICIO</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse" data-bs-target="#RegistrarA" aria-expanded="false" aria-controls="Registrar_ambiente" style="text-decoration: none;">
                    <img width="25" height="25" src="https://img.icons8.com/ios-filled/50/plus-2-math.png" alt="plus-2-math" style="filter: invert(100%);margin-right: 10px;"/>
                    <span>REGISTRO AMBIENTES</span>
                </a>
                <ul id="RegistrarA" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="./RegistrodeAmbiente.php" class="sidebar-link"  data-bs-target="#staticBackdrop2" style="text-decoration: none;">REGISTRAR UN AMBIENTE</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="./ambientes_csv.php" class="sidebar-link" style="text-decoration: none;">REGISTRAR VARIOS AMBIENTES</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="listaDeAmbientesRegistrados.php" class="sidebar-link" style="text-decoration: none;">LISTA DE AMBIENTES REGISTRADOS</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse" data-bs-target="#RegistrarU" aria-expanded="false" aria-controls="RegistrodeAmbiente" style="text-decoration: none;">
                    <img width="25" height="25" src="https://img.icons8.com/ios-filled/50/add-user-male.png" alt="plus-2-math" style="filter: invert(100%);margin-right: 10px;"/>
                    <span>REGISTRAR USUARIO</span>
                </a>
                <ul id="RegistrarU" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="../usuarios/RegistroUsuario.php" class="sidebar-link" data-bs-target="#staticBackdrop2" style="text-decoration: none;">REGISTRAR USUARIO</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="../usuarios/RegistroMasivousuario.php" class="sidebar-link" style="text-decoration: none;">REGISTRAR VARIOS USUARIOS</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="../usuarios/listaDeUsuariosRegistrados.php" class="sidebar-link" style="text-decoration: none;">LISTA DE USUARIOS REGISTRADOS</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a href="../usuarios/VerificarSolicitud.php" class="sidebar-link" style="text-decoration: none;">
                    <img width="25" height="25" src="https://img.icons8.com/ios-filled/50/approval.png" alt="approval" style="filter: invert(100%);margin-right: 10px;"/>
                    <span>VERIFICAR SOLICITUD</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="../../notificaciones/notificaciones.php" class="sidebar-link" style="text-decoration: none;">
                    <i class="bi bi-envelope-paper-heart-fill fs-4"></i>
                    <span>NOTIFICACIONES</span>
                </a>
            </li>
        </ul>
    </aside>
    <main class="main" id="main">
        <h2>Detalles de la Reserva</h2>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3>Detalles de la Reserva</h3>
                    <p><strong>ID Reserva:</strong> <?php echo $detalle_reserva['ID_RESERVA']; ?></p>
                    <p><strong>ID Usuario:</strong> <?php echo $detalle_reserva['ID_USUARIO']; ?></p>
                    <p><strong>Nombre del Ambiente:</strong> <?php echo $detalle_reserva['NOMBRE_AMBIENTE']; ?></p>
                    <p><strong>Fecha de Inicio:</strong> <?php echo $detalle_reserva['FECHA_INICIO']; ?></p>
                    <p><strong>Fecha de Fin:</strong> <?php echo $detalle_reserva['FECHA_FIN']; ?></p>
                    <p><strong>Capacidad:</strong> <?php echo $detalle_reserva['CAPACIDAD']; ?></p>
                    <form action="procesarReservas.php" method="POST">
                        <input type="hidden" name="id_reserva" value="<?php echo $detalle_reserva['ID_RESERVA']; ?>">
                        <button type="submit" name="accion" value="aceptar" class="btn btn-success">Aceptar</button>
                        <button type="submit" name="accion" value="rechazar" class="btn btn-danger">Rechazar</button>
                    </form>
                </div>
                <div class="col-12">
                    <h3>Ambientes Disponibles</h3>
                    <?php if (!empty($ambientes_disponibles)): ?>
                        <ul>
                            <?php foreach ($ambientes_disponibles as $ambiente): ?>
                                <li><?php echo $ambiente['NOMBRE']; ?> (Capacidad: <?php echo $ambiente['CAPACIDAD']; ?>)</li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p>No hay ambientes disponibles con la capacidad requerida.</p>
                    <?php endif; ?>
                </div>
                <div class="col-12">
                    <h3>Sugerencias de Ambientes en el mismo piso</h3>
                    <?php if (!empty($sugerencias_ambientes)): ?>
                        <ul>
                            <?php foreach ($sugerencias_ambientes as $sugerencia): ?>
                                <li><?php echo $sugerencia['NOMBRE']; ?> (Capacidad: <?php echo $sugerencia['CAPACIDAD']; ?>)</li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p>No hay sugerencias de ambientes disponibles en el mismo piso.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-tokeQYfYB+SMlRIgG/5lfX9B7PvllsmXT27pV75WTL6u6mVD1LPq5oTnW3kXTXU7" crossorigin="anonymous"></script>
<script>
    const toggleBtn = document.getElementById('toggle-btn');
    const sidebar = document.getElementById('sidebar');
    const main = document.getElementById('main');
    toggleBtn.addEventListener('click', function() {
        sidebar.classList.toggle('active');
        main.classList.toggle('active');
    });
</script>
</body>
</html>
