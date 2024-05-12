<?php
require_once '../../config/validacion_session.php';
require_once '../../config/conexion.php';

$correo = $_SESSION['user'];

$query = "SELECT nombre FROM usuarios WHERE correo = '$correo'";
$result = $conexion->query($query);
$row = $result->fetch_assoc();
$nombreUsuario = $row['nombre'];
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
                    <a href="#" class="sidebar-link" style="text-decoration: none;">
                        <i class="bi bi-house-door-fill fs-4"></i>
                        <span>INICIO</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link" style="text-decoration: none;">
                        <img width="25" height="25" src="https://img.icons8.com/ios-filled/50/classroom.png" alt="classroom" style="filter: invert(100%);margin-right: 10px;" />
                        <span>AULAS DISPONIBLES</span>
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
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link" style="text-decoration: none;">
                        <img width="25" height="25" src="https://img.icons8.com/ios-filled/50/classroom.png" alt="classroom" style="filter: invert(100%);margin-right: 10px;" />
                        <span>RESERVAR AMBIENTE</span>
                    </a>
                </li>
            </ul>
        </aside>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <title>Formulario de Reserva</title>
<link rel="stylesheet" type="text/css" href="../cssp/reserva.css">
        
        <script>
function nextStep() {
    var currentStep = document.querySelector('.step:not([style*="none"])');
    var nextStep = currentStep.nextElementSibling;
    currentStep.style.display = "none";
    nextStep.style.display = "block";
}

function prevStep() {
    var currentStep = document.querySelector('.step:not([style*="none"])');
    var prevStep = currentStep.previousElementSibling;
    currentStep.style.display = "none";
    prevStep.style.display = "block";
}
function nextStep() {
    // Capturar valores del paso 1
    var fecha = document.getElementById('fecha').value;
    var horario = document.getElementById('horario').value;

    // Mostrar valores del paso 1 en el paso 3
    document.getElementById('reserva-info').innerHTML = "<p>Fecha: " + fecha + "</p><p>Horario: " + horario + "</p>";

    // Capturar valores del paso 2
    var nombres = document.getElementById('nombres').value;
    var apellidos = document.getElementById('apellidos').value;
    var correo = document.getElementById('correo').value;
    var materia = document.getElementById('materia').value;
    var grupo = document.getElementById('grupo').value;
    var tipoActividad = document.getElementById('tipoActividad').value;

    // Mostrar valores del paso 2 en el paso 3
    document.getElementById('docente-info').innerHTML = "<p>Nombres: " + nombres + "</p><p>Apellidos: " + apellidos + "</p><p>Correo: " + correo + "</p><p>Materia: " + materia + "</p><p>Grupo: " + grupo + "</p><p>Tipo de Actividad: " + tipoActividad + "</p>";

    // Mostrar paso 3 y ocultar paso 1
    var currentStep = document.querySelector('.step:not([style*="none"])');
    var nextStep = currentStep.nextElementSibling;
    currentStep.style.display = "none";
    nextStep.style.display = "block";
}



</script>
        <div class="main p-3">
            <div class="container_ambiente">
        <form action="../../config/procesar_reserva.php" method="post">
            <!-- Paso 1 -->
            <div class="step">
                <h2>Paso 1: Seleccione Fecha y Horario</h2>
                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="fecha" required><br><br>
                <label for="horario">Horario:</label>
                <select id="horario" name="horario" required>
                    <option value="">Seleccione un horario</option>
                        <option value="06:45-08:15">06:45-08:15</option>
                        <option value="08:15-09:45">08:15-09:45</option>
                        <option value="09:45-11:15">09:45-11:15</option>
                        <option value="11:15-12:45">11:15-12:45</option>
                        <option value="12:45-14:15">12:45-14:15</option>
                        <option value="14:15-15:45">14:15-15:45</option>
                        <option value="15:45-17:15">15:45-17:15</option>
                        <option value="17:15-18:45">17:15-18:45</option>
                        <option value="18:45-20:15">18:45-20:15</option>
                        <option value="20:15-21:45">20:15-21:45</option>
                    
                </select><br><br>
                <button type="button" onclick="window.location.href='HomeU.php'">Cancelar</button>
                <button type="button" onclick="nextStep()">Siguiente</button>
            </div>

            <!-- Paso 2 -->
            <div class="step" style="display: none;">
                <h2>Paso 2: Ingrese sus Datos</h2>
                <label for="nombre">Nombres:</label>
                <input type="text" id="nombres" name="nombres" required><br>
                <label for="nombre">Apellidos:</label>
                <input type="text" id="apellidos" name="apellidos" required><br>
                <label for="nombre">Correo Electronico:</label>
                <input type="text" id="correo" name="correo" required><br>
                <label for="nombre">Materia:</label>
                <input type="text" id="materia" name="materia" required><br>
                <label for="nombre">Grupo:</label>
                <input type="text" id="grupo" name="grupo" required><br>
                <label for="tipoActividad">Tipo de Actividad:</label>
                <select id="tipoActividad" name="tipoActividad" required>
                    <option value="">Seleccionar</option>
                        <option value="clases">Clases</option>
                        <option value="examen">Examen</option>
                        <option value="defensa">Defensa</option>
                </select><br>
                <!-- Agrega aquí los demás campos -->
                <button type="button" onclick="prevStep()">Atrás</button>
                <button type="button" onclick="nextStep()">Siguiente</button>
            </div>

           <!-- Paso 3 -->
            <div class="step" style="display: none;">
                <h2>Paso 3: Confirmación</h2>
                <!-- Mostrar datos de la reserva -->
                <div class="info-box">
                    <h3>Datos del Ambiente</h3>
                    <div id="reserva-info">
                        <!-- Aquí se mostrarán los datos -->
                    </div>
                </div>
                <!-- Mostrar datos del docente -->
                <div class="info-box">
                    <h3>Datos del Docente</h3>
                    <div id="docente-info">
                        <!-- Aquí se mostrarán los datos -->
                    </div>
                </div>
                <button type="button" onclick="prevStep()">Atrás</button>
                <button type="submit">Confirmar</button>
            </div>


        </form>
    </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../../js/MenuLateral.js"></script>
</body>

</html>