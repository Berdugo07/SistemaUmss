

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

</head>

<body>

    <header class="header">
        <div class="header-content">
            <div class="header-logo">
                <img src="Img/logoFCyT.jpeg" alt="Logo" width="180" height="65">
            </div>
            <?php if (isset($_GET['error']) && $_GET['error'] === 'cuenta_no_existe') : ?>
                <!-- Mostrar la tarjeta de error si la cuenta no existe -->
                <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
                    <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                    </symbol>
                </svg>
                <div class="alert alert-danger d-flex align-items-center" role="alert" style="font-size: 0.8rem; margin-left:200px;">
                    <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:" width="15" height="15">
                        <use xlink:href="#exclamation-triangle-fill" />
                    </svg>
                    <div>
                        Por favor, verifica tus credenciales e intenta nuevamente.
                    </div>
                </div>
            <?php endif; ?>
            <div class="header-links">
                <i class="bi bi-person-circle"></i>
                <a href="#" class="login-link" data-bs-toggle="modal" data-bs-target="#loginModal">Iniciar sesión</a>
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
                    <a href="Index.php" class="sidebar-link" style="text-decoration: none;">
                        <i class="bi bi-house-door-fill fs-4"></i>
                        <span>INICIO</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="ListaAmbientesSinRegis.php" class="sidebar-link" style="text-decoration: none;">
                        <img width="25" height="25" src="https://img.icons8.com/ios-filled/50/classroom.png" alt="classroom" style="filter: invert(100%);margin-right: 10px;" />
                        <span>LISTA DE AMBIENTES</span>
                    </a>
                </li>
            </ul>
        </aside>
        <div class="main p-3">

        <div class="filtro-container mb-3 text-center">
            <!-- Buscar por nombre de Ambiente -->
            <form method="GET">
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
    <button type="submit" class="btn btn-primary" id="buscar" name="buscar">
    <i class="bi bi-funnel-fill me-1"></i>Buscar
</button>
            </form>

</div>

<div class="row mt-4 card-container" style="max-height: 600px; overflow-y: auto;" id="resultado_busqueda">       
    
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
<div class="row mt-4 card-container" style="max-height: 600px; overflow-y: auto;">       
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
                    <img src="Img/Ambientes/<?php echo $fila['imgAmbiente']; ?>" class="card-img-top" alt="<?php echo $fila['nombre']; ?>">
                <?php } else { ?>
                    <!-- Si no hay imagen registrada, mostrar una imagen por defecto -->
                    <img src="Img/Ambientes/defaultAmbiente.jpg" class="card-img-top" alt="Imagen por defecto">
                <?php } ?>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $fila['nombre']; ?></h5>
                        <p class="card-text">Capacidad Máxima: <?php echo $fila['capacidad']; ?></p>
                        <p class="card-text">Ubicación: <?php echo $fila['ubicacion']; ?></p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AdvertenciaModal">Reservar</button>
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


  <footer class="footer">
        <div class="footer-links">
            <a href="#" class="about-link">Sobre nosotros</a>
        </div>
        <div class="footer-links">
            <div class="social-links">
                <a href="#"><i class="lni lni-facebook-original"></i></a>
                <a href="#"><i class="lni lni-instagram-fill"></i></a>
                <a href="#"><i class="lni lni-twitter-original"></i></a>
            </div>
        </div>
    </footer>

     

    <!--iniciar sesion ventana-->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="px-lg-5 py-lg-4 p-4 w-100 mb-auto d-flex flex-column align-items-center">
                        
                        <h1 class="font-weight-bold mb-4" style="color: #03045E; font-size: 28px;">INICIAR SESIÓN</h1>

                        <form action="config/controlador_login.php" method="POST" onsubmit="return validarFormulario()" class="my-4">

                            <div class="mb-4">
                                <label for="exampleInputEmail1" class="font-weight-bold" style="width: 400px;">Correo electrónico</label>
                                <input type="email" name="correo" class="form-control border" placeholder="Ingresa tu correo electrónico" id="exampleInputEmail1" aria-describedby="emailHelp" style="width: 400px;">
                                <div id="emailError" class="text-danger" style="display: none;">Correo electrónico es obligatorio</div>
                            </div>
                            <div class="mb-4">
                                <label for="exampleInputPassword1" class="form-label font-weight-bold" style="width: 400px;">Contraseña</label>
                                <div class="input-group" style="width: 400px;">
                                    <input type="password" name="contrasena" id="pass" class="form-control border mb-2" placeholder="Ingresa tu contraseña" id="exampleInputPassword1">
                                    <span class="input-group-text" onclick="Vista_form();" style="width: 45px; height: 36px;">
                                        <i class="bi bi-eye-fill text-dark" id="ver"></i>
                                        <i class="bi bi-eye-slash-fill text-dark" id="ocultar" style="display: none;"></i>
                                    </span>
                                </div>
                                <div id="passwordError" class="text-danger" style="display: none;">Contraseña es obligatoria</div>
                                <a href="recpassword.php" id="ContraseñaHelp" class="form-text" style="color: blue; text-decoration: none;">¿Has olvidado tu contraseña?</a>
                            </div>
                            <div class="d-grid gap-2 col-6 mx-auto"> <!-- Contenedor del botón -->
                                <input name="btningresar" type="submit" class="btn btn-primary rounded-pill mt-3" value="Iniciar sesion" style="background-color: #03045E; color: white;">
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="AdvertenciaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-exclamation-triangle-fill text-warning me-2"></i> Advertencia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="px-lg-5 py-lg-4 p-4 w-100 mb-auto d-flex flex-column align-items-center">
                    <h1 class="font-weight-bold mb-4" style="color: #03045E; font-size: 28px;">Inicia sesión para reservar</h1>
                    <p>Para reservar este ambiente, primero necesitas iniciar sesión con tu cuenta.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

    <script>
        function validarFormulario() {
            var email = document.getElementById('exampleInputEmail1').value;
            var password = document.getElementById('pass').value;
            var emailError = document.getElementById('emailError');
            var passwordError = document.getElementById('passwordError');
            var isValid = true;

            // Verificar si el campo de correo electrónico está vacío
            if (email.trim() === '') {
                emailError.style.display = 'block';
                isValid = false;
            } else {
                emailError.style.display = 'none';
            }

            // Verificar si el campo de contraseña está vacío
            if (password.trim() === '') {
                passwordError.style.display = 'block';
                isValid = false;
            } else {
                passwordError.style.display = 'none';
            }

            // Devuelve true si todos los campos están completos, de lo contrario, devuelve false
            return isValid;
        }

        function Vista_form() {
            let pass = document.getElementById('pass');
            let ver = document.getElementById('ver');
            let ocultar = document.getElementById('ocultar');
            if (pass.type === 'password') {
                pass.type = 'text';
                ver.style.display = 'none';
                ocultar.style.display = 'block';
            } else {
                pass.type = 'password';
                ver.style.display = 'block';
                ocultar.style.display = 'none';
            }
        }
        $(document).ready(function() {
                // Esta función se ejecuta cuando se hace clic en el botón de buscar
                $('#btnBuscar').click(function() {
                    buscar_filtro();
                });
            });
    </script>
    
    <script src="js/MenuLateral.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="Filtro.js"></script>
</body>

</html>
