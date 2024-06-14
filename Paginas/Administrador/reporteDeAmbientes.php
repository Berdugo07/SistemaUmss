<?php
require_once '../../config/validacion_session.php';
require_once '../../config/conexion.php';

$correo = $_SESSION['user'];


$query = "SELECT NOMBRE FROM usuario WHERE CORREO = :CORREO";
$stmt = $conexion->prepare($query);
$stmt->bindParam(':CORREO', $correo);
$stmt->execute();
$nombreUsuario = $stmt->fetchColumn();

// Obtener los tipos de ambientes y motivos de reserva
$queryAmbientes = "SELECT DISTINCT tipo_ambiente FROM reservas";
$queryMotivos = "SELECT DISTINCT motivo FROM reservas";

$stmtAmbientes = $conexion->prepare($queryAmbientes);
$stmtMotivos = $conexion->prepare($queryMotivos);

$stmtAmbientes->execute();
$stmtMotivos->execute();

$tiposAmbientes = $stmtAmbientes->fetchAll(PDO::FETCH_COLUMN);
$motivosReservas = $stmtMotivos->fetchAll(PDO::FETCH_COLUMN);

// Obtener las reservas filtradas
$fechaInicio = $_GET['fecha_inicio'] ?? '';
$fechaFin = $_GET['fecha_fin'] ?? '';
$tipoAmbiente = $_GET['tipo_ambiente'] ?? '';
$motivoReserva = $_GET['motivo_reserva'] ?? '';

$queryReservas = "SELECT * FROM reservas WHERE (fecha >= :fechaInicio OR :fechaInicio IS NULL) AND (fecha <= :fechaFin OR :fechaFin IS NULL) AND (tipo_ambiente = :tipoAmbiente OR :tipoAmbiente = '') AND (motivo = :motivoReserva OR :motivoReserva = '')";
$stmtReservas = $conexion->prepare($queryReservas);

$stmtReservas->bindParam(':fechaInicio', $fechaInicio);
$stmtReservas->bindParam(':fechaFin', $fechaFin);
$stmtReservas->bindParam(':tipoAmbiente', $tipoAmbiente);
$stmtReservas->bindParam(':motivoReserva', $motivoReserva);

$stmtReservas->execute();
$reservas = $stmtReservas->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REPORTE DE USO DE AMBIENTES</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="listaDeAmbientesRegistrados.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    

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
                        <li><a class="dropdown-item" href="../../config/controlador_cerrar_sesion.php">Cerar sesion</a></li>
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
                                    <a href="./registrar_usuario.php" class="sidebar-link"  data-bs-target="#staticBackdrop2" style="text-decoration: none;">REGISTRAR UN SOLO USUARIO</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="./formulario_csv.php" class="sidebar-link" style="text-decoration: none;">REGISTRAR VARIOS USUARIOS</a>
                                </li>
                                
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a href="modificar_usuario.php" class="sidebar-link" style="text-decoration: none;">
                                <img width="25" height="25" src="https://img.icons8.com/fluency-systems-filled/48/edit-user.png" alt="USERMODIFICAR" style="filter: invert(100%);margin-right: 10px;" />
                                <span>MODIFICAR CUENTAS DE USUARIO</span>
                            </a>
                        </li>
 
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse" data-bs-target="#Reserva" aria-expanded="false" aria-controls="Reserva" style="text-decoration: none;">
                                <img width="25" height="25" src="https://img.icons8.com/ios-filled/50/reservation-2.png" alt="reservation-2" style="filter: invert(100%);margin-right: 10px;" />
                                <span>RESERVAS</span>
                            </a>
                            <ul id="Reserva" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link" style="text-decoration: none;">A&#65533;ADIR</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link" style="text-decoration: none;">ELIMINAR</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link" style="text-decoration: none;">MODIFICAR</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a href="solicitudesDeReservas.php" class="sidebar-link" style="text-decoration: none;">
                                <img width="25" height="25" src="https://img.icons8.com/ios/50/FFFFFF/requirement.png" alt="requirement" style="margin-right: 10px;"/>
                                <span>SOLICITUDES DE RESERVAS</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link" style="text-decoration: none;">
                                <img width="25" height="25" src="https://img.icons8.com/ios-filled/50/calendar--v1.png" alt="CALENDAR" style="filter: invert(100%);margin-right: 10px;" />
                                <span>CALENDARIO</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="modificar_usuario.php" class="sidebar-link" style="text-decoration: none;">
                                <img width="25" height="25" src="https://img.icons8.com/fluency-systems-filled/48/edit-user.png" alt="USERMODIFICAR" style="filter: invert(100%);margin-right: 10px;" />
                                <span>REPORTE DE USO DE AMBIENTES</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </aside>


        <div class="container mt-4">
            <h1>Reporte de Ambientes</h1>
            <form class="row g-3 mb-4" method="GET" action="reporteDeAmbientes.php">
                <div class="col-md-4">
                    <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
                    <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="<?php echo htmlspecialchars($fechaInicio); ?>">
                </div>
                <div class="col-md-4">
                    <label for="fecha_fin" class="form-label">Fecha Fin</label>
                    <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" value="<?php echo htmlspecialchars($fechaFin); ?>">
                </div>
                <div class="col-md-4">
                    <label for="tipo_ambiente" class="form-label">Tipo de Ambiente</label>
                    <select class="form-select" id="tipo_ambiente" name="tipo_ambiente">
                        <option value="">Todos</option>
                        <?php foreach ($tiposAmbientes as $tipo) : ?>
                            <option value="<?php echo htmlspecialchars($tipo); ?>" <?php echo ($tipo == $tipoAmbiente) ? 'selected' : ''; ?>><?php echo htmlspecialchars($tipo); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="motivo_reserva" class="form-label">Motivo de Reserva</label>
                    <select class="form-select" id="motivo_reserva" name="motivo_reserva">
                        <option value="">Todos</option>
                        <?php foreach ($motivosReservas as $motivo) : ?>
                            <option value="<?php echo htmlspecialchars($motivo); ?>" <?php echo ($motivo == $motivoReserva) ? 'selected' : ''; ?>><?php echo htmlspecialchars($motivo); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">&nbsp;</label>
                    <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                </div>
            </form>

            <div class="row">
                <div class="col-md-6">
                    <h3>Tipos de Ambientes más Usados</h3>
                    <canvas id="ambientesChart"></canvas>
                </div>
                <div class="col-md-6">
                    <h3>Motivos de Reserva</h3>
                    <canvas id="motivosChart"></canvas>
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-md-12">
                    <h3>Reservas</h3>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Tipo de Ambiente</th>
                                <th>Motivo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reservas as $reserva) : ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($reserva['fecha']); ?></td>
                                    <td><?php echo htmlspecialchars($reserva['tipo_ambiente']); ?></td>
                                    <td><?php echo htmlspecialchars($reserva['motivo']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctxAmbientes = document.getElementById('ambientesChart').getContext('2d');
            var ctxMotivos = document.getElementById('motivosChart').getContext('2d');

            var ambientesData = <?php echo json_encode(array_count_values(array_column($reservas, 'tipo_ambiente'))); ?>;
            var motivosData = <?php echo json_encode(array_count_values(array_column($reservas, 'motivo'))); ?>;

            new Chart(ctxAmbientes, {
                type: 'bar',
                data: {
                    labels: Object.keys(ambientesData),
                    datasets: [{
                        label: 'Usos',
                        data: Object.values(ambientesData),
                        backgroundColor: 'rgba(54, 162, 235, 0.6)'
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            new Chart(ctxMotivos, {
                type: 'bar',
                data: {
                    labels: Object.keys(motivosData),
                    datasets: [{
                        label: 'Usos',
                        data: Object.values(motivosData),
                        backgroundColor: 'rgba(75, 192, 192, 0.6)'
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
        </script>
        </body>
        </html>