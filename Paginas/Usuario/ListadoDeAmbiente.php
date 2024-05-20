<?php
require_once '../../config/validacion_session.php';
require_once '../../config/conexion.php';

$correo = $_SESSION['user'];

$query = "SELECT NOMBRE FROM usuario WHERE CORREO = '$correo'";
$result = $conexion->query($query);
$row = $result->fetch_assoc();
$nombreUsuario = $row['NOMBRE'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
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
                    <a href="HomeU.php" class="sidebar-link" style="text-decoration: none;">
                        <i class="bi bi-house-door-fill fs-4"></i>
                        <span>INICIO</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="ListadoDeAmbiente.php" class="sidebar-link" style="text-decoration: none;">
                        <img width="25" height="25" src="https://img.icons8.com/ios-filled/50/classroom.png" alt="classroom" style="filter: invert(100%);margin-right: 10px;" />
                        <span>LISTA DE AMBIENTES</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse" data-bs-target="#Reserva" aria-expanded="false" aria-controls="Reserva" style="text-decoration: none;">
                        <img width="25" height="25" src="https://img.icons8.com/ios-filled/50/reservation-2.png" alt="reservation-2" style="filter: invert(100%);margin-right: 10px;" />
                        <span>MIS RESERVAS</span>
                    </a>
                    <ul id="Reserva" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link" style="text-decoration: none;">LISTA DE RESERVAS</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </aside>
        <div class="main p-3">

        <div class="filtro-container mb-3 text-center">
            <!-- Buscar por nombre de Ambiente -->
    <label for="buscarAmbiente" class="me-2">Buscar Ambiente:</label>
    <input type="text" id="buscarAmbiente" name="buscarAmbiente" class="me-2" placeholder="Nombre del Ambiente">

    <!-- Filtro de Piso -->
    <label for="piso" class="me-2">Piso:</label>
    <select name="piso" id="piso" class="me-2">
        <option value="Todos">Todos</option>
        <option value="planta_baja">Planta Baja</option>
        <option value="1er_piso">1er Piso</option>
        <option value="2do_piso">2do Piso</option>
        <option value="3er_piso">3er Piso</option>
    </select>

    <!-- Filtro de Tipo -->
    <label for="tipo" class="me-2">Tipo:</label>
    <select name="tipo" id="tipo" class="me-2">
        <option value="Todos">Todos</option>
        <option value="auditorio">Auditorio</option>
        <option value="laboratorio">Laboratorio</option>
        <option value="aula">Aula</option>
    </select>

    <!-- Filtro de Capacidad -->
    <label for="capacidad" class="me-2">Capacidad:</label>
    <select name="capacidad" id="capacidad" class="me-2">
        <option value="Todos">Todos</option>
        <option value="DESC">De mayor a menor</option>
        <option value="ASC">De menor a mayor</option>
    </select>

    <!-- Botón de Filtrar con icono -->
    <button type="button" class="btn btn-primary" id="btnBuscar">
    <i class="bi bi-funnel-fill me-1"></i>Buscar
</button>

</div>
<div class="row mt-4 card-container" style="max-height: 800px; overflow-y: auto;" id="resultado_busqueda">       
    
<style>
    .card-img-top {
        width: 100%; /* Ancho máximo del contenedor */
        height: 200px; /* Altura fija para todas las imágenes */
        object-fit: cover; /* Escalar la imagen para cubrir el contenedor */
    }
    .card-container {
        margin-left: 50px; /* Ajusta el valor del margen según tu preferencia */
        margin-right: 50px; /* Ajusta el valor del margen según tu preferencia */
    }
    .card {
        border-radius: 15px; /* Bordes redondeados */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra predeterminada */
        transition: box-shadow 0.3s ease, transform 0.3s ease; /* Transición suave de la sombra y la transformación */
    }
    .card:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Sombra más pronunciada al pasar el mouse */
        transform: translateY(-20px); /* Levanta la tarjeta al pasar el mouse */
    }
    @media (min-width: 1545px) {
        .card-container .col-md-3 {
            flex: 0 0 25%;
            max-width: 25%;
        }
    }

    @media (max-width: 1545px) {
        .card-container .col-md-3 {
            flex: 0 0 33.33%;
            max-width: 33.33%;
        }
    }

    @media (max-width: 1351px) {
        .card-container .col-md-3 {
            flex: 0 0 50%;
            max-width: 50%;
        }
    }

    @media (max-width: 854px) {
        .card-container .col-md-3 {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }
</style>
<div class="row mt-4 card-container" style="max-height: 900px; overflow-y: auto;">       
    <?php
    // Conexión a la base de datos
    $host = "localhost";
    $user = "root";
    $password = "";
    $db = "reservasumss1";

    $conexion = new mysqli($host, $user, $password, $db);

    if ($conexion->connect_errno) {
        echo "Fallo la conexión a la base: " . $conexion->connect_errno;
    }

    // Consulta para obtener los datos de la tabla "ambientes"
    // Consulta para obtener los datos de la tabla "ambientes" con estado habilitado
$query = "SELECT nombre, capacidad, ubicacion, imgAmbiente FROM ambientes WHERE estado = 'habilitado'";
    $resultado = $conexion->query($query);

    // PHP para mostrar los resultados de ambientes
    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            // Mostrar resultados de ambientes
            ?>
            <div class="col-md-3 mb-4">
                <div class="card" style="width: 18rem;">
                <?php if (!empty($fila['imgAmbiente'])) { ?>
                    <!-- Si hay una imagen registrada, mostrarla -->
                    <img src="../../Img/Ambientes/<?php echo $fila['imgAmbiente']; ?>" class="card-img-top" alt="<?php echo $fila['nombre']; ?>">
                <?php } else { ?>
                    <!-- Si no hay imagen registrada, mostrar una imagen por defecto -->
                    <img src="../../Img/Ambientes/defaultAmbiente.jpg" class="card-img-top" alt="Imagen por defecto">
                <?php } ?>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $fila['nombre']; ?></h5>
                        <p class="card-text">Capacidad Máxima: <?php echo $fila['capacidad']; ?></p>
                        <p class="card-text">Ubicación: <?php echo $fila['ubicacion']; ?></p>
                        <button type="button" class="btn btn-primary" onclick="window.location.href = 'reserva_ambiente.php';">Reservar</button>
                    </div>
                </div>
            </div>
            <?php
        }
    } else {
        echo "No se encontraron ambientes en la base de datos.";
    }
    $conexion->close();
    ?>
</div>
           
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../../js/MenuLateral.js"></script>
</body>

</html>