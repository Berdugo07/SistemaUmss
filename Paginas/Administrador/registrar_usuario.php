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
                        <li><a class="dropdown-item" href="../../config/controlador_cerrar_sesion.php">Cerrar sesion</a></li>
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
                        <a href="RegistrodeAmbiente.php" class="sidebar-link"  data-bs-target="#staticBackdrop2" style="text-decoration: none;">REGISTRO DE AMBIENTE</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="listaDeAmbientesRegistrados.php" class="sidebar-link" style="text-decoration: none;">LISTA DE AMBIENTES REGISTRADOS</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="./registrar_usuario.php" class="sidebar-link" style="text-decoration: none;">
                        <img width="25" height="25" src="https://img.icons8.com/ios-filled/50/add-user-male.png" alt="useregistro" style="filter: invert(100%);margin-right: 10px;" />
                        <span>REGISTRAR USUARIO</span>
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
                    <a href="#" class="sidebar-link" style="text-decoration: none;">
                        <img width="25" height="25" src="https://img.icons8.com/ios-filled/50/classroom.png" alt="classroom" style="filter: invert(100%);margin-right: 10px;" />
                        <span>AULAS DISPONIBLES</span>
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
                        <span>MODIFICAR CUENTA DE USUARIO</span>
                    </a>
                </li>
            </ul>
        </aside>

        <title>Registrar Usuario</title>
<link rel="stylesheet" type="text/css" href="../cssp/styles.css">
<script>
function enviarFormulario() {
    // Obtener el formulario
    var formulario = document.getElementById("formularioRegistro");
    var contrasena = document.getElementById("contrasena").value;
    var confirmarContrasena = document.getElementById("confirmar_contrasena").value;
    if (contrasena !== confirmarContrasena) {
        alert("Las contraseñas no coinciden. Por favor, intenta de nuevo.");
        return;
    }
    // Enviar el formulario utilizando AJAX
    var xhr = new XMLHttpRequest();
    xhr.open(formulario.method, formulario.action, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Si la respuesta es exitosa, mostrar el mensaje en una ventana emergente
            var respuesta = xhr.responseText;
            mostrarVentanaEmergente(respuesta);
            // Borrar los datos del formulario
            formulario.reset();
            // Aumentar el tamaño del cuerpo
            document.body.style.fontSize = "20px";
        } else {
            // Si hay un error en la respuesta, mostrar un mensaje de error
            alert('Error al registrar usuario: ' + xhr.statusText);
        }
    };

    xhr.send(new URLSearchParams(new FormData(formulario)))
}

function mostrarVentanaEmergente(mensaje) {
    // Crear la ventana emergente
    var ventanaEmergente = document.createElement('div');
    ventanaEmergente.classList.add('ventana-emergente');

    // Crear el contenido de la ventana emergente
    var contenido = document.createElement('div');
    contenido.classList.add('contenido');
    contenido.innerHTML = mensaje;

    // Crear el botón para cerrar la ventana emergente
    var botonCerrar = document.createElement('button');
    botonCerrar.textContent = 'Aceptar';
    botonCerrar.addEventListener('click', function() {
        // Cerrar la ventana emergente al hacer clic en el botón
        document.body.removeChild(ventanaEmergente);
    });

    // Agregar el contenido y el botón a la ventana emergente
    ventanaEmergente.appendChild(contenido);
    ventanaEmergente.appendChild(botonCerrar);

    // Agregar la ventana emergente al cuerpo del documento
    document.body.appendChild(ventanaEmergente);
}
function togglePasswordVisibility(inputId) {
    var input = document.getElementById(inputId);
    var icon = document.getElementById('toggle' + inputId.charAt(0).toUpperCase() + inputId.slice(1) + 'Icon');

    if (input.type === "password") {
        input.type = "text";
        icon.textContent = " 👁️‍🗨️";
    } else {
        input.type = "password";
        icon.textContent = "🔒";
    }
}


</script>
</head>
<body>

        <div class="main p-3">
            <div class="container">
                <h2>Registrar Usuario</h2>
                <!-- Agregar el identificador al formulario y llamar a la función JavaScript al hacer clic en el botón Registrar -->
                <form id="formularioRegistro" method="post" action="../../config/procesar_registro.php" onsubmit="event.preventDefault(); enviarFormulario();">
                    <input type="text" name="nombre" placeholder="Nombres" required>
                    <input type="text" name="apellido" placeholder="Apellidos" required>
                    <input type="email" name="correo" placeholder="Correo electrónico" required>

                    <input type="password" name="contrasena" id="contrasena" placeholder="Contraseña" required>
                    <span class="toggle-password" onclick="togglePasswordVisibility('contrasena')">
                        <i id="togglePasswordIcon"> 👁️‍🗨️</i> 
                    </span>
                    <input type="password" name="confirmar_contrasena" id="confirmar_contrasena" placeholder="Confirmar Contraseña" required>
                    <span class="toggle-password" onclick="togglePasswordVisibility('confirmar_contrasena')">
                        <i id="toggleConfirmPasswordIcon"> 👁️‍🗨️</i>
                    </span>

                    <input type="text" name="materias" placeholder="Materias" required> 
                    <input type="text" name="carrera" placeholder="Carrera" required>
                    <select name="rol" required>
                        <option value="1">Administrador</option>
                        <option value="2">Docente</option>
                    </select>
                    <button type="submit">Registrar</button>
                    <button type="button" onclick="window.location.href='./HomeA.php'">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../../js/MenuLateral.js"></script>
</body>

</html>