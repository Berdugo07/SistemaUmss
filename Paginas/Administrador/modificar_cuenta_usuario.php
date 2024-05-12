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
    <link rel="stylesheet" href="../../css/m_cuenta_usuario.css">
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
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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





        
        <div class="main p-3"> 
        
        <div class="container mt-5" >
        
                    <div class="row justify-content-center">
                        <div class="col-md-8  p-4 rounded shadow" style="background-color: #6372FF;">
                        <h3 class="text-center text-white">Formulario de Modificar Usuario</h3>
                        
                        <form method="POST" action="">
                        
                            <?php
                                include('../../config/obtener_usuario_modificar.php');
                                
                                    $ci_new = isset($_GET['ci_new']) ? $_GET['ci_new'] : null;
                                    
                                    $nombre_modificar = obtener_nombre($ci_new);
                                    $apellido_modificar = obtener_apellido($ci_new);
                                    $ci_modificar = obtener_correo($ci_new);
                                    
                                    if($_SERVER["REQUEST_METHOD"] == "POST"){
                                        if (!empty($_POST['nombre']) && !empty($_POST['apellido']) ) { 
                                            $nombre = $_POST['nombre'];
                                            $apellido = $_POST['apellido'];
                                                                        
                                            // Realiza la actualización en la base de datos
                                            $sql = "UPDATE usuarios SET nombre='$nombre', apellido='$apellido' WHERE ci='$ci_new'";
                                            
                                            $conexion = new mysqli('localhost', 'root', '', 'reservasumss1');
                                            // Ejecuta la consulta
                                            if (mysqli_query($conexion, $sql)) {
                                                // Redirige a la página de modificación con el parámetro ci_new
                                                
                                                 // ¡Importante! Asegúrate de salir del script después de la redirección.
                                                 
                                                echo '<script>
                                                        Swal.fire({
                                                            icon: "success",
                                                            title: "Éxito",
                                                            text: "Usuario actualizado con éxito.",
                                                            didClose: () => {
                                                                window.location.href = "modificar_cuenta_usuario.php?ci_new='.$ci_new.'";
                                                            }
                                                        });
                                                    </script>';
                 
                                            } else {
                                                echo "<p>Error al actualizar el usuario: " . mysqli_error($conexion) . "</p>";
                                            }  
                                        }else{
                                            echo   '<script>
                                                        Swal.fire({
                                                            icon: "error",
                                                            title: "Error",
                                                            text: "Por favor, complete todos los campos."
                                                        });
                                                    </script>';
                                        }                            
                                    }
                            ?>
                            
                            <div class="row mb-3">
                                                               
                            <div class="col-md-6">
                                <label for="nombre" class="form-label text-white">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder=<?php echo $nombre_modificar?>>
                                
                            </div>
                            <div class="col-md-6">
                                <label for="apellido" class="form-label text-white">Apellido:</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" placeholder=<?php echo $apellido_modificar?>>
                            </div>
                            <div class="mb-3">
                            <label for="Materia" class="form-label text-white">Materia:</label>
                            <input type="text" class="form-control" placeholder= "Programacion 1">
                            </div>
                            <div class="mb-3">
                            <label for="Carrera" class="form-label text-white">Carrera:</label>
                            <input type="text" class="form-control" placeholder= "Ingenieria de Sistemas" >
                            </div>
                            </div>
                            <div class="d-flex justify-content-center">
    <button type="submit" class="btn btn-primary me-2" id="b_boton" name="b_boton">GUARDAR</button>
    <a href="modificar_usuario.php" class="btn btn-danger ms-2">CANCELAR</a>
</div>

                            
                        </form>
                        </div>
                    </div>
                    </div>  

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../../js/MenuLateral.js"></script>
</body>

</html>