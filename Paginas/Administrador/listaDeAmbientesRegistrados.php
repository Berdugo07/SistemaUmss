<?php
// Conexión a la base de datos

$host = "localhost";
$dbname = "reservasumss1"; 
$username = "root"; 
$password = ""; 


try {
    $conexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}

// Consultar la base de datos para obtener los ambientes registrados

$stmt = $conexion->query("SELECT * FROM ambientes");
$ambientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
    <title>Lista de Ambientes Registrados</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="listaDeAmbientesRegistrados.css">
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
                    <a href="#" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse" data-bs-target="#RegistrarA" aria-expanded="false" aria-controls="RegistrarA" style="text-decoration: none;">
                    <img width="25" height="25" src="https://img.icons8.com/ios-filled/50/plus-2-math.png" alt="plus-2-math" style="filter: invert(100%);margin-right: 10px;"/>
                        <span>REGISTRAR AMBIENTE</span>
                    </a>
                    <ul id="RegistrarA" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                                <a href="RegistrodeAmbiente.php" class="sidebar-link" style="text-decoration: none;">REGISTRO DE AMBIENTE</a>
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
                        <a href="./registrar_usuario.php" class="sidebar-link"  data-bs-target="#staticBackdrop2" style="text-decoration: none;">REGISTRAR UN SOLO USUARIO</a>
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


        <div class="main p-3">
    <div class="container text-center">
        <h2 class="lista-title">LISTA DE AMBIENTES REGISTRADOS</h2>
    
        <form action="accion.php" method="POST">
            <div style="height: 700px; overflow-y: auto;">
                <table class="table table-striped">
                    <thead class="thead-sticky">
                        <tr>
                            <th>Imagen</th>
                            <th>Nombre</th>
                            <th>Capacidad</th>
                            <th>Ubicación</th>
                            <th>Piso</th>
                            <th>Periodo de Examen</th>
                            <th>Fecha de Inicio</th>
                            <th>Fecha de Fin</th>
                            <th>Horarios</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                         $host = "localhost";
                         $user = "root";
                         $password="";
                         $db = "reservasumss1";
                        
                         $conexion= new mysqli($host,$user,$password,$db);
                        
                        $ambientes_sql = mysqli_query($conexion , "SELECT * FROM ambientes");
                        while ($ambientes = mysqli_fetch_array($ambientes_sql)){ ?>    
                            <tr>
                                <td><img src="../../Img/Ambientes/<?php echo $ambientes[9]; ?>" alt="" width="100"></td>
                                <td><?php echo $ambientes[1]; ?></td>
                                <td><?php echo $ambientes[2]; ?></td>
                                <td><?php echo $ambientes[3]; ?></td>
                                <td><?php echo $ambientes[4]; ?></td>
                                <td><?php echo $ambientes[5]; ?></td>
                                <td><?php echo $ambientes[6]; ?></td>
                                <td><?php echo $ambientes[7]; ?></td>
                                <td><?php echo $ambientes[8]; ?></td>
                                <td>
                                <a href='editarAmbiente.php?id=<?php echo $ambientes['id']; ?>' class='btn btn-primary'><i class="bi bi-pencil"></i>Editar</a>
    <a href='eliminarAmbiente.php?id=<?php echo $ambientes['id']; ?>' class='btn btn-danger'><i class="bi bi-trash"></i>Eliminar</a>
</td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="../../js/MenuLateral.js"></script>
</body>
</html>
