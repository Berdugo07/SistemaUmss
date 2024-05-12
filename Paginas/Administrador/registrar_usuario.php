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
                            <a href="./ambientes_csv.php" class="sidebar-link" style="text-decoration: none;">REGISTRAR VARIOS AMBIENTES</a>
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

                    <select name="materias" required>
                        <option value="">Selecciona una materia</option>
                        <option value="Accionamiento Y Simulación Electrotécnica">Accionamiento Y Simulación Electrotécnica</option>
                        <option value="Administración De Proyectos">Administración De Proyectos</option>
                        <option value="Aeropuertos">Aeropuertos</option>
                        <option value="Algebra">Algebra</option>
                        <option value="Algebra Abstracta I">Algebra Abstracta I</option>
                        <option value="Algebra I">Algebra I</option>
                        <option value="Algebra II">Algebra II</option>
                        <option value="Algebra Lineal">Algebra Lineal</option>
                        <option value="Algebra Lineal Y Matricial">Algebra Lineal Y Matricial</option>
                        <option value="Algebra Lineal Y Teoría Matricial">Algebra Lineal Y Teoría Matricial</option>
                        <option value="Algoritmos Avanzados">Algoritmos Avanzados</option>
                        <option value="Análisis De Señales">Análisis De Señales</option>
                        <option value="Análisis Funcional">Análisis Funcional</option>
                        <option value="Análisis I">Análisis I</option>
                        <option value="Análisis III">Análisis III</option>
                        <option value="Análisis Instrumental">Análisis Instrumental</option>
                        <option value="Análisis Numérico">Análisis Numérico</option>
                        <option value="Análisis Numérico I">Análisis Numérico I</option>
                        <option value="Análisis Numérico III">Análisis Numérico III</option>
                        <option value="Análisis Vectorial Y Tensorial">Análisis Vectorial Y Tensorial</option>
                        <option value="Análisis Y Diseño De Procesos Químicos">Análisis Y Diseño De Procesos Químicos</option>
                        <option value="Anatomía Comparada">Anatomía Comparada</option>
                        <option value="Aplicación De Sistemas Operativos">Aplicación De Sistemas Operativos</option>
                        <option value="Arquitectura De Computadoras I">Arquitectura De Computadoras I</option>
                        <option value="Arquitectura De Computadoras II">Arquitectura De Computadoras II</option>
                        <option value="Arquitectura De Software">Arquitectura De Software</option>
                        <option value="Artropodologia">Artropodologia</option>
                        <option value="Astronomía">Astronomía</option>
                        <option value="Automatización Y Control">Automatización Y Control</option>
                        <option value="Bacteriología">Bacteriología</option>
                        <option value="Base De Datos I">Base De Datos I</option>
                        <option value="Base De Datos II">Base De Datos II</option>
                        <option value="Bioclimatología">Bioclimatología</option>
                        <option value="Bioestadística">Bioestadística</option>
                        <option value="Bioestadística II">Bioestadística II</option>
                        <option value="Biofísica">Biofísica</option>
                        <option value="Biogeografía">Biogeografía</option>
                        <option value="Biología Celular">Biología Celular</option>
                        <option value="Biología Celular Y Molecular">Biología Celular Y Molecular</option>
                        <option value="Biología General">Biología General</option>
                        <option value="Bioquímica">Bioquímica</option>
                        <option value="Business Intelligence Y Big Data">Business Intelligence Y Big Data</option>
                        <option value="Calculo">Calculo</option>
                        <option value="Calculo Complejo">Calculo Complejo</option>
                        <option value="Calculo Computarizado">Calculo Computarizado</option>
                        <option value="Calculo I">Calculo I</option>
                        <option value="Calculo II">Calculo II</option>
                        <option value="Calculo III">Calculo III</option>
                        <option value="Calculo Numérico">Calculo Numérico</option>
                        <option value="Carreteras I">Carreteras I</option>
                        <option value="Carreteras II">Carreteras II</option>
                        <option value="Centrales Hidráulicas">Centrales Hidráulicas</option>
                        <option value="Centrales Térmicas">Centrales Térmicas</option>
                        <option value="Ciencia De Datos Y Machine Learning">Ciencia De Datos Y Machine Learning</option>
                        <option value="Ciencia De Los Materiales">Ciencia De Los Materiales</option>
                        <option value="Ciencia De Los Materiales II">Ciencia De Los Materiales II</option>
                        <option value="Circuitos Eléctricos I">Circuitos Eléctricos I</option>
                        <option value="Circuitos Eléctricos II">Circuitos Eléctricos II</option>
                        <option value="Circuitos Eléctricos III">Circuitos Eléctricos III</option>
                        <option value="Circuitos Electrónicos">Circuitos Electrónicos</option>
                        <option value="Cloud Computing">Cloud Computing</option>
                        <option value="Computación I">Computación I</option>
                        <option value="Computación Para Ingeniería">Computación Para Ingeniería</option>
                        <option value="Comunicación De Datos">Comunicación De Datos</option>
                        <option value="Construcción De Edificios">Construcción De Edificios</option>
                        <option value="Contabilidad Básica">Contabilidad Básica</option>
                        <option value="Control Y Automatización Industrial">Control Y Automatización Industrial</option>
                        <option value="Costos Industriales">Costos Industriales</option>
                        <option value="Cultivo De Tejidos Vegetales">Cultivo De Tejidos Vegetales</option>
                        <option value="Derecho Empresarial">Derecho Empresarial</option>
                        <option value="Dibujo Mecánico">Dibujo Mecánico</option>
                        <option value="Dibujo Técnico">Dibujo Técnico</option>
                        <option value="Dibujo Técnico Computarizado">Dibujo Técnico Computarizado</option>
                        <option value="Dinámica">Dinámica</option>
                        <option value="Dinámica De Sistemas">Dinámica De Sistemas</option>
                        <option value="Dinámica Y Control De Procesos">Dinámica Y Control De Procesos</option>
                        <option value="Dirección De Obras Y Valuaciones">Dirección De Obras Y Valuaciones</option>
                        <option value="Diseño Asistido Por Computadora">Diseño Asistido Por Computadora</option>
                        <option value="Diseño De Electrónica Analógica">Diseño De Electrónica Analógica</option>
                        <option value="Diseño De Maquinas I">Diseño De Maquinas I</option>
                        <option value="Diseño De Plantas Agro">Diseño De Plantas Agro</option>
                        <option value="Diseño De Plantas Químicas">Diseño De Plantas Químicas</option>
                        <option value="Diseño De Reactores I">Diseño De Reactores I</option>
                        <option value="Diseño De Reactores II">Diseño De Reactores II</option>
                        <option value="Diseño De Sistemas Digitales I">Diseño De Sistemas Digitales I</option>
                        <option value="Diseño De Sistemas Digitales II">Diseño De Sistemas Digitales II</option>
                        <option value="Diseño Experimental">Diseño Experimental</option>
                        <option value="Diseños Experimentales">Diseños Experimentales</option>
                        <option value="Ecología De Comunidades Vegetales">Ecología De Comunidades Vegetales</option>
                        <option value="Ecología De Poblaciones Animales">Ecología De Poblaciones Animales</option>
                        <option value="Ecología I">Ecología I</option>
                        <option value="Ecología II">Ecología II</option>
                        <option value="Economía Industrial">Economía Industrial</option>
                        <option value="Economía Política">Economía Política</option>
                        <option value="Economía Y Administración Industrial">Economía Y Administración Industrial</option>
                        <option value="Ecuaciones Diferenciales">Ecuaciones Diferenciales</option>
                        <option value="Electiva III (Física De Materiales)">Electiva III (Física De Materiales)</option>
                        <option value="Electromagnetismo">Electromagnetismo</option>
                        <option value="Electrónica">Electrónica</option>
                        <option value="Electrónica Analógica I">Electrónica Analógica I</option>
                        <option value="Electrónica Analógica II">Electrónica Analógica II</option>
                        <option value="Electrónica De Potencia">Electrónica De Potencia</option>
                        <option value="Electrónica Digital I">Electrónica Digital I</option>
                        <option value="Electrónica Digital II">Electrónica Digital II</option>
                        <option value="Electrotecnia">Electrotecnia</option>
                        <option value="Electrotecnia Industrial">Electrotecnia Industrial</option>
                        <option value="Elem. De Maquinas Y Tecnol. Mecanica">Elem. De Maquinas Y Tecnol. Mecanica</option>
                        <option value="Elem. De Maquinas Y Tecnol. Mecanica I">Elem. De Maquinas Y Tecnol. Mecanica I</option>
                        <option value="Elem. De Programación Y Estruc. De Datos">Elem. De Programación Y Estruc. De Datos</option>
                        <option value="Elementos De Maquinas I">Elementos De Maquinas I</option>
                        <option value="Elementos De Maquinas II">Elementos De Maquinas II</option>
                        <option value="Elementos Finitos">Elementos Finitos</option>
                        <option value="Embriología Comparada">Embriología Comparada</option>
                        <option value="Energías Alternativas">Energías Alternativas</option>
                        <option value="Entornos Virtuales De Aprendizaje">Entornos Virtuales De Aprendizaje</option>
                        <option value="Equilibrios En Disolución">Equilibrios En Disolución</option>
                        <option value="Estadística">Estadística</option>
                        <option value="Estadística Aplicada">Estadística Aplicada</option>
                        <option value="Estadística I">Estadística I</option>
                        <option value="Estadística II">Estadística II</option>
                        <option value="Estática">Estática</option>
                        <option value="Estructura Y Semántica De Lenguajes De Progra">Estructura Y Semántica De Lenguajes De Progra</option>
                        <option value="Estructuras De Acero">Estructuras De Acero</option>
                        <option value="Estructuras De Madera Y Metálicas">Estructuras De Madera Y Metálicas</option>
                        <option value="Estructuras Discretas">Estructuras Discretas</option>
                        <option value="Estructuras Especiales">Estructuras Especiales</option>
                        <option value="Estructuras Hiperestáticas">Estructuras Hiperestáticas</option>
                        <option value="Estructuras Isostáticas">Estructuras Isostáticas</option>
                        <option value="Evaluación Y Auditoria De Sistemas">Evaluación Y Auditoria De Sistemas</option>
                        <option value="Evolución">Evolución</option>
                        <option value="Fenómenos De Transporte A">Fenómenos De Transporte A</option>
                        <option value="Fenómenos De Transporte B">Fenómenos De Transporte B</option>
                        <option value="Fenómenos De Transporte General">Fenómenos De Transporte General</option>
                        <option value="Física Básica I">Física Básica I</option>
                        <option value="Física Básica II">Física Básica II</option>
                        <option value="Física Básica III">Física Básica III</option>
                        <option value="Física Básica IV">Física Básica IV</option>
                        <option value="Física Computacional I">Física Computacional I</option>
                        <option value="Física General">Física General</option>
                        <option value="Física I">Física I</option>
                        <option value="Física II">Física II</option>
                        <option value="Física Moderna">Física Moderna</option>
                        <option value="Física Teórica I">Física Teórica I</option>
                        <option value="Física Teórica III">Física Teórica III</option>
                        <option value="Fisicoquímica">Fisicoquímica</option>
                        <option value="Fisicoquímica II">Fisicoquímica II</option>
                        <option value="Fisicoquímica III">Fisicoquímica III</option>
                        <option value="Fisiología De Invertebrados">Fisiología De Invertebrados</option>
                        <option value="Fisiología De Vertebrados">Fisiología De Vertebrados</option>
                        <option value="Fisiología Vegetal">Fisiología Vegetal</option>
                        <option value="Fractales">Fractales</option>
                        <option value="Fundaciones I">Fundaciones I</option>
                        <option value="Fundaciones II">Fundaciones II</option>
                        <option value="Genética De Microorganismos">Genética De Microorganismos</option>
                        <option value="Genética I">Genética I</option>
                        <option value="Genética II">Genética II</option>
                        <option value="Geog. Y Def. De Los Recursos Naturales">Geog. Y Def. De Los Recursos Naturales</option>
                        <option value="Geología">Geología</option>
                        <option value="Geología General">Geología General</option>
                        <option value="Geomática">Geomática</option>
                        <option value="Geometría">Geometría</option>
                        <option value="Geometría Analítica">Geometría Analítica</option>
                        <option value="Geometría Descriptiva">Geometría Descriptiva</option>
                        <option value="Geometría I">Geometría I</option>
                        <option value="Geometría III">Geometría III</option>
                        <option value="Gestión Ambiental">Gestión Ambiental</option>
                        <option value="Gestión De Calidad">Gestión De Calidad</option>
                        <option value="Gestión De Calidad De Software">Gestión De Calidad De Software</option>
                        <option value="Gestión Estratégica De Empresas">Gestión Estratégica De Empresas</option>
                        <option value="Gestión Y Calidad Ambiental">Gestión Y Calidad Ambiental</option>
                        <option value="Graficación Por Computadora">Graficación Por Computadora</option>
                        <option value="Hidráulica Aplicada">Hidráulica Aplicada</option>
                        <option value="Hidráulica De Ríos">Hidráulica De Ríos</option>
                        <option value="Hidráulica I">Hidráulica I</option>
                        <option value="Hidráulica II">Hidráulica II</option>
                        <option value="Hidrología">Hidrología</option>
                        <option value="Histología Animal Comparada">Histología Animal Comparada</option>
                        <option value="Hormigón Armado I">Hormigón Armado I</option>
                        <option value="Hormigón Armado II">Hormigón Armado II</option>
                        <option value="Hormigón Preesforzado">Hormigón Preesforzado</option>
                        <option value="Industria De Bebidas">Industria De Bebidas</option>
                        <option value="Industria De Frutas Y Hortalizas">Industria De Frutas Y Hortalizas</option>
                        <option value="Industria De Los Cereales">Industria De Los Cereales</option>
                        <option value="Industrias Cárnicas">Industrias Cárnicas</option>
                        <option value="Industrias De Grasas Y Aceites">Industrias De Grasas Y Aceites</option>
                        <option value="Industrias Lácteas">Industrias Lácteas</option>
                        <option value="Informática Forense">Informática Forense</option>
                        <option value="Ingeniería Ambiental">Ingeniería Ambiental</option>
                        <option value="Ingeniería Antisísmica">Ingeniería Antisísmica</option>
                        <option value="Ingeniería Asistida Por Computadora">Ingeniería Asistida Por Computadora</option>
                        <option value="Ingeniería Automotriz">Ingeniería Automotriz</option>
                        <option value="Ingeniería De Alimentos I">Ingeniería De Alimentos I</option>
                        <option value="Ingeniería De Alimentos II">Ingeniería De Alimentos II</option>
                        <option value="Ingeniería De Alimentos III">Ingeniería De Alimentos III</option>
                        <option value="Ingeniería De Métodos Y Reingeniería">Ingeniería De Métodos Y Reingeniería</option>
                        <option value="Ingeniería De Seguridad">Ingeniería De Seguridad</option>
                        <option value="Ingeniería De Sistemas I">Ingeniería De Sistemas I</option>
                        <option value="Ingeniería De Sistemas II">Ingeniería De Sistemas II</option>
                        <option value="Ingeniería De Software">Ingeniería De Software</option>
                        <option value="Ingeniería De Trafico">Ingeniería De Tráfico</option>
                        <option value="Ingeniería Económica">Ingeniería Económica</option>
                        <option value="Ingeniería Sanitaria I">Ingeniería Sanitaria I</option>
                        <option value="Ingeniería Sanitaria II">Ingeniería Sanitaria II</option>
                        <option value="Ingles">Inglés</option>
                        <option value="Ingles I">Inglés I</option>
                        <option value="Ingles II">Inglés II</option>
                        <option value="Ingles III">Inglés III</option>
                        <option value="Ingles Técnico">Inglés Técnico</option>
                        <option value="Inmunoparasitologia">Inmunoparasitología</option>
                        <option value="Instalaciones Dom. Const. De Obras Sanitarias">Instalaciones Dom. Const. De Obras Sanitarias</option>
                        <option value="Instalaciones Eléctricas I">Instalaciones Eléctricas I</option>
                        <option value="Instalaciones Eléctricas II">Instalaciones Eléctricas II</option>
                        <option value="Instalaciones Eléctricas Industriales I">Instalaciones Eléctricas Industriales I</option>
                        <option value="Instalaciones Eléctricas Industriales II">Instalaciones Eléctricas Industriales II</option>
                        <option value="Instalaciones Electromecánicas">Instalaciones Electromecánicas</option>
                        <option value="Instrumentación Procesos">Instrumentación Procesos</option>
                        <option value="Inteligencia Artificial">Inteligencia Artificial</option>
                        <option value="Inteligencia Artificial I">Inteligencia Artificial I</option>
                        <option value="Inteligencia Artificial II">Inteligencia Artificial II</option>
                        <option value="Interacción Humano Computador">Interacción Humano Computador</option>
                        <option value="Introducción A La Física Del Estado Solido">Introducción A La Física Del Estado Solido</option>
                        <option value="Introducción A La Física Nuclear Y De Partica">Introducción A La Física Nuclear Y De Partica</option>
                        <option value="Introducción A La Ingeniería Bioquímica">Introducción A La Ingeniería Bioquímica</option>
                        <option value="Introducción A La Ingeniería Medio Ambiental">Introducción A La Ingeniería Medio Ambiental</option>
                        <option value="Introducción A La Programación">Introducción A La Programación</option>
                        <option value="Introducción A Los Procesos Químicos">Introducción A Los Procesos Químicos</option>
                        <option value="Investigación De Mercados">Investigación De Mercados</option>
                        <option value="Investigación Operativa">Investigación Operativa</option>
                        <option value="Investigación Operativa I">Investigación Operativa I</option>
                        <option value="Investigación Operativa II">Investigación Operativa II</option>
                        <option value="Laboratorio De Análisis De Alimentos">Laboratorio De Análisis De Alimentos</option>
                        <option value="Laboratorio De Fisicoquímica">Laboratorio De Fisicoquímica</option>
                        <option value="Laboratorio De Ingeniería Sanitaria">Laboratorio De Ingeniería Sanitaria</option>
                        <option value="Laboratorio De Operaciones Unitarias I">Laboratorio De Operaciones Unitarias I</option>
                        <option value="Laboratorio De Operaciones Unitarias II">Laboratorio De Operaciones Unitarias II</option>
                        <option value="Laboratorio De Química Analítica Cualitativa">Laboratorio De Química Analítica Cualitativa</option>
                        <option value="Laboratorio De Química Analítica Cuantitativa">Laboratorio De Química Analítica Cuantitativa</option>
                        <option value="Laboratorio De Química General">Laboratorio De Química General</option>
                        <option value="Laboratorio De Química Orgánica">Laboratorio De Química Orgánica</option>
                        <option value="Laboratorio De Química Orgánica II">Laboratorio De Química Orgánica II</option>
                        <option value="Laboratorio De Reactores">Laboratorio De Reactores</option>
                        <option value="Laboratorio De Termodinámica">Laboratorio De Termodinámica</option>
                        <option value="Laboratorio Medio">Laboratorio Medio</option>
                        <option value="Líneas De Transmisión Y Propagación">Líneas De Transmisión Y Propagación</option>
                        <option value="Líneas Eléctricas I">Líneas Eléctricas I</option>
                        <option value="Líneas Eléctricas II">Líneas Eléctricas II</option>
                        <option value="Lógica">Lógica</option>
                        <option value="Mantenimiento Eléctrico">Mantenimiento Eléctrico</option>
                        <option value="Mantenimiento Industrial">Mantenimiento Industrial</option>
                        <option value="Maquinaria Y Equipo De Construcción">Maquinaria Y Equipo De Construcción</option>
                        <option value="Maquinas Asíncronas">Maquinas Asíncronas</option>
                        <option value="Maquinas Dc">Maquinas Dc</option>
                        <option value="Máquinas De Elevación Y Transporte">Máquinas De Elevación Y Transporte</option>
                        <option value="Maquinas Hidráulicas">Maquinas Hidráulicas</option>
                        <option value="Maquinas Neumáticas">Maquinas Neumáticas</option>
                        <option value="Maquinas Síncronas">Maquinas Síncronas</option>
                        <option value="Maquinas Térmicas">Maquinas Térmicas</option>
                        <option value="Maquinas Térmicas I">Maquinas Térmicas I</option>
                        <option value="Maquinas Térmicas II">Maquinas Térmicas II</option>
                        <option value="Matemática Computacional II">Matemática Computacional II</option>
                        <option value="Matemática Discreta">Matemática Discreta</option>
                        <option value="Mecanica Cuántica I">Mecanica Cuántica I</option>
                        <option value="Mecanica De Fluidos">Mecanica De Fluidos</option>
                        <option value="Mecanica De Suelos Aplicada">Mecanica De Suelos Aplicada</option>
                        <option value="Mecanica De Suelos I">Mecanica De Suelos I</option>
                        <option value="Mecanica De Suelos II">Mecanica De Suelos II</option>
                        <option value="Mecanica Del Medio Continuo">Mecanica Del Medio Continuo</option>
                        <option value="Mecanica Estadística">Mecanica Estadística</option>
                        <option value="Mecanismos">Mecanismos</option>
                        <option value="Mecatrónica">Mecatrónica</option>
                        <option value="Medidas Eléctricas">Medidas Eléctricas</option>
                        <option value="Medidas Electrónicas">Medidas Electrónicas</option>
                        <option value="Mercadeo Y Tarifación">Mercadeo Y Tarifación</option>
                        <option value="Mercadotecnia">Mercadotecnia</option>
                        <option value="Metodol. Y Planif. De Proyecto De Grado">Metodol. Y Planif. De Proyecto De Grado</option>
                        <option value="Metodología De La Investigación">Metodología De La Investigación</option>
                        <option value="Metodología Investigación Y Tec. Comunicación">Metodología Investigación Y Tec. Comunicación</option>
                        <option value="Métodos Constructivos En Geotecnia">Métodos Constructivos En Geotecnia</option>
                        <option value="Métodos Geodésicos">Métodos Geodésicos</option>
                        <option value="Métodos Técnicas Y Taller De Programación">Métodos Técnicas Y Taller De Programación</option>
                        <option value="Métodos Y Técnicas De Programación">Métodos Y Técnicas De Programación</option>
                        <option value="Micología I">Micología I</option>
                        <option value="Microbiología De Aire Y Suelo">Microbiología De Aire Y Suelo</option>
                        <option value="Microbiología De Los Alimentos">Microbiología De Los Alimentos</option>
                        <option value="Microprocesadores I">Microprocesadores I</option>
                        <option value="Microprocesadores II">Microprocesadores II</option>
                        <option value="Modelos Hidráulicos">Modelos Hidráulicos</option>
                        <option value="Morfología Y Anatomía Vegetal">Morfología Y Anatomía Vegetal</option>
                        <option value="Multimedia">Multimedia</option>
                        <option value="Nutrición">Nutrición</option>
                        <option value="Obras Hidráulicas I">Obras Hidráulicas I</option>
                        <option value="Obras Hidráulicas II">Obras Hidráulicas II</option>
                        <option value="Operaciones Industriales I">Operaciones Industriales I</option>
                        <option value="Operaciones Industriales II">Operaciones Industriales II</option>
                        <option value="Operaciones Industriales III">Operaciones Industriales III</option>
                        <option value="Operaciones Unitarias I">Operaciones Unitarias I</option>
                        <option value="Operaciones Unitarias II">Operaciones Unitarias II</option>
                        <option value="Operaciones Unitarias III">Operaciones Unitarias III</option>
                        <option value="Óptica">Óptica</option>
                        <option value="Óptica Y Espectroscopia Molecular">Óptica Y Espectroscopia Molecular</option>
                        <option value="Organización Industrial">Organización Industrial</option>
                        <option value="Organización Y Métodos">Organización Y Métodos</option>
                        <option value="Planif. Y Control De La Producción I">Planif. Y Control De La Producción I</option>
                        <option value="Planif. Y Control De La Producción II">Planif. Y Control De La Producción II</option>
                        <option value="Planificación Organización Y Control De Calid">Planificación Organización Y Control De Calid</option>
                        <option value="Planificación Y Evaluación De Proyectos">Planificación Y Evaluación De Proyectos</option>
                        <option value="Planta De Tratamiento De Aguas Residuales">Planta De Tratamiento De Aguas Residuales</option>
                        <option value="Plantas De Purificación De Agua Potable">Plantas De Purificación De Agua Potable</option>
                        <option value="Practica Empresarial">Practica Empresarial</option>
                        <option value="Practica En La Industria">Practica En La Industria</option>
                        <option value="Practica Profesionalizante">Practica Profesionalizante</option>
                        <option value="Prep. Y Eval. De Proyectos I">Prep. Y Eval. De Proyectos I</option>
                        <option value="Prep. Y Eval. De Proyectos Ii">Prep. Y Eval. De Proyectos Ii</option>
                        <option value="Preparación De Proyecto De Grado">Preparación De Proyecto De Grado</option>
                        <option value="Preparación Y Evaluación De Proyectos">Preparación Y Evaluación De Proyectos</option>
                        <option value="Preparación Y Evaluación De Proyectos I">Preparación Y Evaluación De Proyectos I</option>
                        <option value="Preparación Y Evaluación De Proyectos Ii">Preparación Y Evaluación De Proyectos Ii</option>
                        <option value="Probabilidad Y Estadística">Probabilidad Y Estadística</option>
                        <option value="Probabilidad Y Estadística I">Probabilidad Y Estadística I</option>
                        <option value="Probabilidad Y Estadística II">Probabilidad Y Estadística II</option>
                        <option value="Procesos Agiles">Procesos Agiles</option>
                        <option value="Procesos Industriales I">Procesos Industriales I</option>
                        <option value="Procesos Industriales II">Procesos Industriales II</option>
                        <option value="Programación">Programación</option>
                        <option value="Programación Funcional">Programación Funcional</option>
                        <option value="Programación Web">Programación Web</option>
                        <option value="Protección De Sistemas Eléctricos">Protección De Sistemas Eléctricos</option>
                        <option value="Proyecto De Grado">Proyecto De Grado</option>
                        <option value="Proyecto Final">Proyecto Final</option>
                        <option value="Proyecto Terminal I">Proyecto Terminal I</option>
                        <option value="Proyecto Terminal II">Proyecto Terminal II</option>
                        <option value="Psicología Industrial">Psicología Industrial</option>
                        <option value="Puentes">Puentes</option>
                        <option value="Puertos Y Vías Navegables">Puertos Y Vías Navegables</option>
                        <option value="Química Analítica">Química Analítica</option>
                        <option value="Química Analítica II">Química Analítica II</option>
                        <option value="Química Analítica III">Química Analítica III</option>
                        <option value="Química Analítica IV">Química Analítica IV</option>
                        <option value="Química Biológica">Química Biológica</option>
                        <option value="Química De Alimentos">Química De Alimentos</option>
                        <option value="Química Del Medio Ambiente">Química Del Medio Ambiente</option>
                        <option value="Química General">Química General</option>
                        <option value="Química Inorgánica">Química Inorgánica</option>
                        <option value="Química Inorgánica III">Química Inorgánica III</option>
                        <option value="Química Orgánica">Química Orgánica</option>
                        <option value="Química Orgánica II">Química Orgánica II</option>
                        <option value="Química Orgánica III">Química Orgánica III</option>
                        <option value="Reconocimiento De Voz">Reconocimiento De Voz</option>
                        <option value="Recursos Humanos">Recursos Humanos</option>
                        <option value="Recursos Naturales">Recursos Naturales</option>
                        <option value="Redes Avanzadas De Computadoras">Redes Avanzadas De Computadoras</option>
                        <option value="Redes De Computadoras">Redes De Computadoras</option>
                        <option value="Redes De Distribución">Redes De Distribución</option>
                        <option value="Redes De Nueva Generación">Redes De Nueva Generación</option>
                        <option value="Refrigeración Y Aire Acondicionado">Refrigeración Y Aire Acondicionado</option>
                        <option value="Resistencia De Materiales">Resistencia De Materiales</option>
                        <option value="Resistencia De Materiales I">Resistencia De Materiales I</option>
                        <option value="Resistencia De Materiales II">Resistencia De Materiales II</option>
                        <option value="Robótica">Robótica</option>
                        <option value="Robótica Industrial">Robótica Industrial</option>
                        <option value="Seguridad De Sistemas">Seguridad De Sistemas</option>
                        <option value="Seminario De Grado">Seminario De Grado</option>
                        <option value="Separaciones Químicas">Separaciones Químicas</option>
                        <option value="Servicios Telemáticos">Servicios Telemáticos</option>
                        <option value="Simulación De Sistemas">Simulación De Sistemas</option>
                        <option value="Simulación De Sistemas De Potencia">Simulación De Sistemas De Potencia</option>
                        <option value="Síntesis Orgánica">Síntesis Orgánica</option>
                        <option value="Sistemas De Calidad En Alimentos">Sistemas De Calidad En Alimentos</option>
                        <option value="Sistemas De Control">Sistemas De Control</option>
                        <option value="Sistemas De Control Dinámico">Sistemas De Control Dinámico</option>
                        <option value="Sistemas De Información I">Sistemas De Información I</option>
                        <option value="Sistemas De Información II">Sistemas De Información II</option>
                        <option value="Sistemas De Ingeniería">Sistemas De Ingeniería</option>
                        <option value="Sistemas De Potencia I">Sistemas De Potencia I</option>
                        <option value="Sistemas De Potencia II">Sistemas De Potencia II</option>
                        <option value="Sistemas De Potencia III">Sistemas De Potencia III</option>
                        <option value="Sistemas Dinámicos">Sistemas Dinámicos</option>
                        <option value="Sistemas Económicos">Sistemas Económicos</option>
                        <option value="Sistemas Hidráulicos Y Neumáticos">Sistemas Hidráulicos Y Neumáticos</option>
                        <option value="Sistemas I">Sistemas I</option>
                        <option value="Sistemas II">Sistemas II</option>
                        <option value="Sistemática De Aves">Sistemática De Aves</option>
                        <option value="Sistemática De Criptógamas">Sistemática De Criptógamas</option>
                        <option value="Sistemática De Fanerógamas">Sistemática De Fanerógamas</option>
                        <option value="Sistemática De Mamíferos">Sistemática De Mamíferos</option>
                        <option value="Subestaciones">Subestaciones</option>
                        <option value="Taller Avanzado I">Taller Avanzado I</option>
                        <option value="Taller De Base De Datos">Taller De Base De Datos</option>
                        <option value="Taller De Control Y Automatismo">Taller De Control Y Automatismo</option>
                        <option value="Taller De Grado">Taller De Grado</option>
                        <option value="Taller De Grado I">Taller De Grado I</option>
                        <option value="Taller De Grado II">Taller De Grado II</option>
                        <option value="Taller De Ingeniería De Software">Taller De Ingeniería De Software</option>
                        <option value="Taller De Modalidades De Graduación I">Taller De Modalidades De Graduación I</option>
                        <option value="Taller De Programación En Bajo Nivel">Taller De Programación En Bajo Nivel</option>
                        <option value="Taller De Redacción Y Comunicación">Taller De Redacción Y Comunicación</option>
                        <option value="Taller De Simulación De Sistemas">Taller De Simulación De Sistemas</option>
                        <option value="Taller De Sistemas Operativos">Taller De Sistemas Operativos</option>
                        <option value="Taller De Tesis I">Taller De Tesis I</option>
                        <option value="Taller Tesis II">Taller Tesis II</option>
                        <option value="Taxonomía Vegetal">Taxonomía Vegetal</option>
                        <option value="Técnicas De Alta Tensión">Técnicas De Alta Tensión</option>
                        <option value="Tecnología De Los Materiales De Construcción">Tecnología De Los Materiales De Construcción</option>
                        <option value="Tecnología Del Frio">Tecnología Del Frio</option>
                        <option value="Tecnología Mecanica I">Tecnología Mecanica I</option>
                        <option value="Tecnología Mecanica II">Tecnología Mecanica II</option>
                        <option value="Tecnología Química">Tecnología Química</option>
                        <option value="Tecnología Redes Avanzadas">Tecnología Redes Avanzadas</option>
                        <option value="Telecomunicaciones">Telecomunicaciones</option>
                        <option value="Telecomunicaciones I">Telecomunicaciones I</option>
                        <option value="Telecomunicaciones II">Telecomunicaciones II</option>
                        <option value="Telecomunicaciones III">Telecomunicaciones III</option>
                        <option value="Temas Especiales En Hidráulica">Temas Especiales En Hidráulica</option>
                        <option value="Temas Especiales En Ingeniería Geotecnia">Temas Especiales En Ingeniería Geotecnia</option>
                        <option value="Tensores Y Formas">Tensores Y Formas</option>
                        <option value="Teoría Axiomática De Conjuntos">Teoría Axiomática De Conjuntos</option>
                        <option value="Teoría De Autómatas Y Leng. Formales">Teoría De Autómatas Y Leng. Formales</option>
                        <option value="Teoría De Control">Teoría De Control</option>
                        <option value="Teoría De Grafos">Teoría De Grafos</option>
                        <option value="Teoría De La Lubricación">Teoría De La Lubricación</option>
                        <option value="Teoría Y Ensayo De Materiales">Teoría Y Ensayo De Materiales</option>
                        <option value="Termodinámica">Termodinámica</option>
                        <option value="Termodinámica General">Termodinámica General</option>
                        <option value="Termodinámica I">Termodinámica I</option>
                        <option value="Termodinámica II">Termodinámica II</option>
                        <option value="Tesis">Tesis</option>
                        <option value="Tópicos Eléctricos I (Telefonía Básica)">Tópicos Eléctricos I (Telefonía Básica)</option>
                        <option value="Tópicos Electrónicos (Aviónica)">Tópicos Electrónicos (Aviónica)</option>
                        <option value="Tópicos Electrónicos (Telefonía Básica)">Tópicos Electrónicos (Telefonía Básica)</option>
                        <option value="Trabajo De Grado">Trabajo De Grado</option>
                        <option value="Trabajo Dirigido (Opcional)">Trabajo Dirigido (Opcional)</option>
                        <option value="Transferencia De Calor">Transferencia De Calor</option>
                        <option value="Transformadas De Fourier">Transformadas De Fourier</option>
                        <option value="Transformadas Integrales">Transformadas Integrales</option>
                        <option value="Transformadores">Transformadores</option>
                        <option value="Transportes Y Comunicaciones">Transportes Y Comunicaciones</option>
                        <option value="Variable Compleja">Variable Compleja</option>
                        <option value="Vías Férreas">Vías Férreas</option>
                        <option value="Vibraciones">Vibraciones</option>
                        <option value="Virología">Virología</option>
                        <option value="Zoología De Invertebrados">Zoología De Invertebrados</option>
                        <option value="Zoología De Vertebrados">Zoología De Vertebrados</option>
                        <!-- Continúa agregando todas las opciones -->
                    </select>
                    <select name="carrera" required>
                        <option value="">Selecciona una carrera</option>
                        <option value="Ingeniería en Alimentos">Ingeniería en Alimentos</option>
                        <option value="Licenciatura en Biología">Licenciatura en Biología</option>
                        <option value="Ingeniería Civil">Ingeniería Civil</option>
                        <option value="Ingeniería Mecánica">Ingeniería Mecánica</option>
                        <option value="Ingeniería Electromecánica">Ingeniería Electromecánica</option>
                        <option value="Ingeniería Industrial">Ingeniería Industrial</option>
                        <option value="Ingeniería Eléctrica">Ingeniería Eléctrica</option>
                        <option value="Ingeniería Electrónica">Ingeniería Electrónica</option>
                        <option value="Ingeniería Informática">Ingeniería Informática</option>
                        <option value="Ingeniería en Sistemas">Ingeniería en Sistemas</option>
                        <option value="Ingeniería Química">Ingeniería Química</option>
                        <option value="Ingeniería en Matemáticas">Ingeniería en Matemáticas</option>
                        <option value="Licenciatura en Matemáticas">Licenciatura en Matemáticas</option>
                        <option value="Licenciatura en Física">Licenciatura en Física</option>
                        <option value="Licenciatura en Química">Licenciatura en Química</option>
                        <option value="Ingeniería Petroquímica">Ingeniería Petroquímica</option>
                        <option value="Ingeniería en Biotecnología">Ingeniería en Biotecnología</option>
                    </select>

                    <select name="rol" required>
                        <option value="">Selecciona un rol</option>
                        <option value="2">Docente</option>
                        <option value="1">Administrador</option>   
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