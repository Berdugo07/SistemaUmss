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
                    <a href="#" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse" data-bs-target="#RegistrarU" aria-expanded="false" aria-controls="Registrar_ambiente" style="text-decoration: none;">
                    <img width="25" height="25" src="https://img.icons8.com/ios-filled/50/add-user-male.png" alt="plus-2-math" style="filter: invert(100%);margin-right: 10px;"/>
                        <span>REGISTRAR USUARIO</span>
                    </a>
                    <ul id="RegistrarU" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                        <a href="#" class="sidebar-link"  data-bs-target="#staticBackdrop2" style="text-decoration: none;">REGISTRAR UN SOLO USUARIO</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="./formulario_csv.php" class="sidebar-link" style="text-decoration: none;">REGISTRAR VARIOS USUARIOS</a>
                        </li>
                    </ul>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
function enviarFormulario() {
    // Obtener el formulario y los valores de los campos
    var formulario = document.getElementById("formularioRegistro");
    var nombre = document.getElementsByName("nombre")[0].value;
    var apellido = document.getElementsByName("apellido")[0].value;
    var ci = document.getElementsByName("ci")[0].value;
    var correo = document.getElementsByName("correo")[0].value;
    var contrasena = document.getElementById("contrasena").value;
    var confirmarContrasena = document.getElementById("confirmar_contrasena").value;
    var materias = document.getElementsByName("materias")[0].value;
    var carrera = document.getElementsByName("carrera")[0].value;
    
    // Expresiones regulares para las validaciones
    var letras = /^[a-zA-Z\s]+$/;
    var numeros = /^[0-9]+$/;

    // Validar nombre y apellido
    // Validar nombre y apellido
    if (!nombre.match(letras) || nombre.length < 4) {
        mostrarErrorCampo("nombre", "El nombre solo debe contener letras y tener al menos 4 caracteres.");
        return;
    }
    if (!apellido.match(letras) || apellido.length < 4) {
        mostrarErrorCampo("apellido", "El apellido solo debe contener letras y tener al menos 4 caracteres.");
        return;
    }

    // Validar CI
    if (!ci.match(numeros) || ci.length < 7) {
        mostrarErrorCampo("ci", "La cédula de identidad solo debe contener números y tener al menos 7 dígitos.");
        return;
    }

    // Validar materias
    if (!materias.match(letras) ||materias.length < 4) {
        mostrarErrorCampo("materias", "El campo de materias debe tener al menos 4 caracteres.");
        return;
    }

    // Validar carrera
    if (!carrera.match(letras) || carrera.length < 4) {
        mostrarErrorCampo("carrera", "La carrera solo debe contener letras y tener al menos 4 caracteres.");
        return;
    }

    // Validar correo electrónico
    // Se puede utilizar una expresión regular para validar el formato del correo, 
    // pero por simplicidad en este ejemplo no se incluye.

    // Validar contraseñas
    if (contrasena.length < 8 || contrasena !== confirmarContrasena) {
        mostrarErrorCampo("contrasena", "Las contraseñas deben tener al menos 8 caracteres y coincidir.");
        return;
    }

    // Si todas las validaciones pasan, enviar el formulario
    var xhr = new XMLHttpRequest();
    xhr.open(formulario.method, formulario.action, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            var respuesta = xhr.responseText;
            mostrarVentanaEmergente(respuesta);
            formulario.reset();
            document.body.style.fontSize = "20px";
        } else {
            alert('Error al registrar usuario: ' + xhr.statusText);
        }
    };
    xhr.send(new URLSearchParams(new FormData(formulario)));
}

// Función para mostrar errores debajo de los campos correspondientes
function mostrarErrorCampo(campo, mensaje) {
    var elementoCampo = document.getElementsByName(campo)[0];
    var errorElemento = document.createElement("div");
    errorElemento.className = "error-mensaje";
    errorElemento.textContent = mensaje;
    
    // Verificar si el campo es la contraseña
    if (campo === 'contrasena') {
        var contenedorPadre = elementoCampo.parentNode;
        var icono = contenedorPadre.querySelector('.toggle-password');
        
        if (icono) {
            // Si hay un icono, insertar el mensaje de error después del icono
            contenedorPadre.insertBefore(errorElemento, icono.nextSibling);
            return; // Salir de la función, ya que hemos insertado el mensaje de error
        }
    }
    
    // Insertar el mensaje de error debajo del campo
    var contenedorCampo = elementoCampo.parentNode;
    contenedorCampo.insertBefore(errorElemento, elementoCampo.nextSibling);
}





// Función para eliminar los mensajes de error
function limpiarMensajesError() {
    var errores = document.querySelectorAll(".error-mensaje");
    errores.forEach(function(error) {
        error.parentNode.removeChild(error);
    });
}


function mostrarVentanaEmergente(respuesta) {
    if (respuesta.includes("Error") || respuesta.includes("correo electrónico ya está registrado")) {
        Swal.fire({
            title: "Error",
            text: respuesta,
            icon: "error",
            confirmButtonText: "Aceptar"
        });
    } else {
        Swal.fire({
            title: "¡Buen trabajo!",
            text: respuesta,
            icon: "success",
            confirmButtonText: "Aceptar"
        });
    }
}




function togglePasswordVisibility(inputId) {
    var input = document.getElementById(inputId);
    var icon = document.getElementById('toggle' + inputId.charAt(0).toUpperCase() + inputId.slice(1) + 'Icon');

    if (input.type === "password") {
        input.type = "text";
        icon.innerHTML = "👁️‍🗨️";
    } else {
        input.type = "password";
        icon.innerHTML = "🔒";
    }
}


</script>

</head>
<body>

        <div class="main p-3">
            <div class="container"style="margin-top:-10px;">
                <h2>Registrar Usuario</h2>
                <!-- Agregar el identificador al formulario y llamar a la función JavaScript al hacer clic en el botón Registrar -->
                
                <form id="formularioRegistro" method="post" action="../../config/procesar_registro.php" onsubmit="event.preventDefault(); limpiarMensajesError(); enviarFormulario();">

                    <input type="text" name="nombre" placeholder="Nombres" required>
                    <input type="text" name="apellido" placeholder="Apellidos" required>
                    <input type="text" name="ci" placeholder="Cédula de Identidad" required>
                    <input type="email" name="correo" placeholder="Correo electrónico" required>
                    <input type="password" name="contrasena" id="contrasena" placeholder="Contraseña" required>
                    <span class="toggle-password" onclick="togglePasswordVisibility('contrasena')">
                    <i class="bi bi-eye-fill text-dark" id="toggleConfirmPasswordIcon"></i>
                    </span>
                    <input type="password" name="confirmar_contrasena" id="confirmar_contrasena" placeholder="Confirmar Contraseña" required>
                    <span class="toggle-password" onclick="togglePasswordVisibility('confirmar_contrasena')">
                        <i class="bi bi-eye-fill text-dark" id="toggleConfirmPasswordIcon"></i>
                    </span>

                    <input type="text" name="materias" placeholder="Materias" required> 
                    <input type="text" name="carrera" placeholder="Carrera" required>
                    <select name="rol" required>
                        <option value="1">Administrador</option>
                        <option value="2">Docente</option>
                    </select>
                    <button type="submit" class="btn btn-primary">REGISTRAR</button>
                    <button type="button" class="btn btn-danger" onclick="window.location.href='./HomeA.php'">CANCELAR</button>
                </form>
            </div>
        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../../js/MenuLateral.js"></script>
</body>

</html>