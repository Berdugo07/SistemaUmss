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

// Consulta SQL para obtener todas las solicitudes de reservas
$sql = "SELECT r.ID_RESERVA, a.NOMBRE AS ambiente, u.NOMBRE AS usuario, r.FECHA_RESERVA, h.HORA
        FROM reserva r
        JOIN ambiente a ON r.ID_AMBIENTE = a.ID_AMBIENTE
        JOIN usuario u ON r.ID_USUARIO = u.ID_USUARIO
        JOIN horario h ON r.ID_HORARIO = h.ID_HORARIO
        WHERE 1";

if (isset($_GET['busqueda']) && !empty($_GET['busqueda'])) {
    $termino_busqueda = $_GET['busqueda'];

    if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $termino_busqueda)) {
        $sql .= " AND r.FECHA_RESERVA = '$termino_busqueda'";
    } elseif (is_numeric($termino_busqueda)) {
        $sql .= " AND a.CAPACIDAD >= $termino_busqueda";
    } else {
        $sql .= " AND a.NOMBRE LIKE '%$termino_busqueda%'";
    }
}

if (isset($_GET['orden'])) {
    $orden = $_GET['orden'];
    $sql .= " ORDER BY r.FECHA_RESERVA $orden";
}

if (isset($_GET['fecha'])) {
    $fecha = $_GET['fecha'];
    if ($fecha == 'hoy') {
        $sql .= " AND DATE(r.FECHA_RESERVA) = CURDATE()";
    } elseif ($fecha == 'semana') {
        $sql .= " AND r.FECHA_RESERVA >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK)";
    }
}

$resultado = $conexion->query($sql);
if (!$resultado) {
    die("Error en la consulta de reservas: " . $conexion->error);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOLICITUDES DE RESERVA DE AMBIENTES</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="listaDeAmbientesRegistrados.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>
        #buscarForm {
            display: flex;
            align-items: center;
        }

        #buscarIcono {
            font-size: 1.2em;
            margin-left: 5px;
            cursor: pointer;
        }

        .title-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .filters-wrapper {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .filters-wrapper {
                flex-direction: column;
            }
        }
    </style>

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
</body>
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
                            <a href="#" class="sidebar-link" style="text-decoration: none;">AÑADIR</a>
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
        
            </ul>
        </aside>


        <div class="main p-3">
            <div class="container">
                <div class="title-wrapper">            
                    <h2 class="lista-title">SOLICITUD DE RESERVA DE AMBIENTES</h2>
                </div>
                <form id="buscarForm" method="GET" style="margin-left: auto; margin-right: 20px; width: 300px;">                   
                    <input type="text" name="busqueda" placeholder="Buscar por nombre, fecha (YYYY-MM-DD) o capacidad" style="width: 100%;">
                    <button type="submit" style="display: none;"></button> 
                    <i class="bi bi-search" id="buscarIcono"></i> 
                </form>
                <div class="filters-wrapper">
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <!-- Filtro de orden -->
                            <label for="orden" class="sidebar-link">Ordenar:</label>
                            <select id="orden" name="orden">
                                <option value="asc">Ascendente</option>
                                <option value="desc">Descendente</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <!-- Filtro de fecha -->
                            <label for="filtroFecha" class="sidebar-link">Por Fecha:</label>
                            <select id="filtroFecha" name="fecha">
                                <option value="hoy">Hoy</option>
                                <option value="semana">Última semana</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive"></div>
            <table id="tablaSolicitudes" class="table table-striped">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Nombre</th>
                        <th>Capacidad</th>
                        <th>Horario</th>
                        <th>Docente</th>
                        <th>Grupo</th>
                        <th>Materia</th>
                        <th>Estado</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if ($resultado && $resultado->num_rows > 0) {
                    while ($fila = $resultado->fetch_assoc()) {
                ?>    
                        <tr> 
                            <td><?php echo htmlspecialchars($fila['FECHA']); ?></td>   
                            <td><?php echo htmlspecialchars($fila['AMBIENTE']); ?></td>   
                            <td><?php echo htmlspecialchars($fila['CAPACIDAD']); ?></td>   
                            <td><?php echo htmlspecialchars($fila['HORA']); ?></td>   
                            <td><?php echo htmlspecialchars($fila['USUARIO']); ?></td>   
                            <td><?php echo htmlspecialchars($fila['MOTIVO']); ?></td>   
                            <td><?php echo htmlspecialchars($fila['ESTADO']); ?></td>   
                            <td>
                                <a href='procesarReserva.php?id=<?php echo $fila['ID_RESERVA']; ?>' class='btn btn-primary'>Aceptar</a>
                                <a href='ProcesarResesrva.php?id=<?php echo $fila['ID_RESERVA']; ?>' class='btn btn-primary'>Rechazar</a>
                            </td>
                        </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='5'>No hay solicitudes de reservas.</td></tr>";
                    } 
                            
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="../../js/MenuLateral.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


</body>
</html>