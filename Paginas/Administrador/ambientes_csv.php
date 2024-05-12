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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
                            <a href="solicitudesDeReservas.php" class="sidebar-link" style="text-decoration: none;">SOLICITUDES DE RESERVAS</a>
                        </li>
                    </ul>
                </li>
            
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link" style="text-decoration: none;">
                        <img width="25" height="25" src="https://img.icons8.com/ios-filled/50/calendar--v1.png" alt="CALENDAR" style="filter: invert(100%);margin-right: 10px;" />
                        <span>CALENDARIO</span>
                    </a>
                </li>
        
            </ul>
        </aside>
        
        <title>SUBIR ARCHIVO CSV</title>
    <link rel="stylesheet" type="text/css" href="../cssp/csv.css">
    <!-- Incluir SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
    function mostrarMensaje(mensaje, icono) {
    Swal.fire({
        title: "Mensaje",
        text: mensaje,
        icon: icono,
        confirmButtonText: "Aceptar"
    });
}
        function limpiarambientes() {
            document.getElementById('ambientesCSV').reset();
        }

        document.addEventListener('DOMContentLoaded', function () {
            var ambientes = document.getElementById('ambientesCSV');
            formulario.addEventListener('submit', function (event) {
                event.preventDefault();
                var formData = new FormData(ambientes);

                fetch('../../config/procesarA_csv.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        mostrarMensaje(data.error, 'error');
                    } else if (data.success) {
                        mostrarMensaje(data.success, 'success');
                        limpiarambientes();
                    } else if (data.errors) {
                        data.errors.forEach(error => mostrarMensaje(error, 'error'));
                    }
                })
                .catch(error => {
                    mostrarMensaje('Hubo un error al procesar la solicitud.', 'error');
                    console.error('Error:', error);
                });
            });
        });
    </script>
</head>
<body>
<div class="main p-3">
    <div class="container">
        <h2>SUBIR ARCHIVO CSV</h2>
        <form id="ambientesCSV" method="post" action="../../config/procesarA_csv.php" enctype="multipart/form-data">
            <input type="file" name="archivo_csv" accept=".csv" required>
            <div class="button-group">
                <button type="submit" class="btn btn-primary">SUBIR CSV</button>
                <button type="button" class="btn btn-danger" onclick="window.location.href='./HomeA.php'">CANCELAR</button>
            </div>
        </form>
    </div>
</div>
</body>
    




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../../js/MenuLateral.js"></script>
</body>

</html>
