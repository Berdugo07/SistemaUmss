<?php
// Conexión a la base de datos
$host = "localhost";
$dbname = "proyectotis2";
$username = "root";
$password = "";

try {
    $conexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

session_start();
if (!isset($_SESSION['user'])) {
    die("Usuario no encontrado.");
}
$correo = $_SESSION['user'];

try {
    $query = "SELECT NOMBRE FROM usuario WHERE CORREO = :correo";
    $stmt = $conexion->prepare($query);
    $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
    $stmt->execute();

    $nombreUsuario = $stmt->fetchColumn();
    if (!$nombreUsuario) {
        die("Usuario no encontrado.");
    }
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>
        #buscarForm {
        display: flex;
        align-items: center;
        }

        /* Estilo del icono de búsqueda */
        #buscarIcono {
            font-size: 1.2em;
            margin-left: 5px;
            cursor: pointer;
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
                        <a href="#" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse" data-bs-target="#RegistrarA" aria-expanded="false" aria-controls="RegistrarA" style="text-decoration: none;">
                            <img width="25" height="25" src="https://img.icons8.com/ios-filled/50/plus-2-math.png" alt="plus-2-math" style="filter: invert(100%);margin-right: 10px;"/>
                            <span>REGISTRAR AMBIENTE</span>
                        </a>
                        <ul id="RegistrarA" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="registrar_ambiente.php" class="sidebar-link" style="text-decoration: none;">REGISTRO DE AMBIENTE</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="listaDeAmbientesRegistrados.php" class="sidebar-link" style="text-decoration: none;">LISTA DE AMBIENTES REGISTRADOS</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link" style="text-decoration: none;">
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
                        <a href="solicitudesDeReservas.php" class="sidebar-link" style="text-decoration: none;">
                            <img width="25" height="25" src="https://img.icons8.com/ios/50/FFFFFF/requirement.png" alt="requirement" style="margin-right: 10px;"/>
                            <span>SOLICITUDES DE RESERVAS</span>
                        </a>
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
                        <a href="#" class="sidebar-link" style="text-decoration: none;">
                            <img width="25" height="25" src="https://img.icons8.com/fluency-systems-filled/48/edit-user.png" alt="USERMODIFICAR" style="filter: invert(100%);margin-right: 10px;" />
                            <span>MODIFICAR CUENTA DE USUARIO</span>
                        </a>
                    </li>
                </ul>
            </aside>


            <div class="main p-3">
                <div class="container text-center" style="height: 400px; overflow-y: auto;">
                    <h2 class="lista-title">LISTA DE AMBIENTES REGISTRADOS</h2>
                    <form id="buscarForm" method="GET" style="margin-left: auto; margin-right: 20px; width: 300px;">
                        <input type="text" name="busqueda" placeholder="Buscar por nombre, estado o capacidad" style="width: 100%;">
                        <button type="submit" style="display: none;"></button> 
                        <i class="bi bi-search" id="buscarIcono"></i> 
                    </form>

                <table id="tablaAmbientes" class="table table-striped">
                    <thead>
                                    <tr>
                                        <th>Imagen</th>
                                        <th>Nombre</th>
                                        <th>Capacidad</th>
                                        <th>Ubicación</th>
                                        <th>Piso</th>
                                        <th>Tipo</th>
                                        <th>Estado</th>
                                        <th>Modificar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $query = $conexion->query("SELECT * FROM ambiente");
                                    while ($ambiente = $query->fetch(PDO::FETCH_ASSOC)) {
                                    ?>    
                                        <tr>
                                            <td><img src="../../Img/Ambientes/<?php echo htmlspecialchars($ambiente['IMG_AMBIENTE']); ?>" alt="" width="100"></td>
                                            <td><?php echo htmlspecialchars($ambiente['NOMBRE']); ?></td>
                                            <td><?php echo htmlspecialchars($ambiente['CAPACIDAD']); ?></td>
                                            <td><?php echo htmlspecialchars($ambiente['UBICACION']); ?></td>
                                            <td><?php echo htmlspecialchars($ambiente['PISO']); ?></td>
                                            <td><?php echo htmlspecialchars($ambiente['TIPO']); ?></td>
                                            <td><?php echo htmlspecialchars($ambiente['ESTADO']); ?></td>
                                            <td><a href='editarAmbiente.php?id=<?php echo htmlspecialchars($ambiente['ID_AMBIENTE']); ?>' class='btn btn-primary'>Editar</a></td>
                                        </tr>
                                    <?php 
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


<script>
$(document).ready(function(){
    $('#buscarForm').submit(function(e){
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'GET',
            url: 'buscar.php',
            data: formData,
            dataType: 'json',
            success: function(data){
                $('#tablaAmbientes tbody').empty();
                $.each(data, function(index, ambiente){
                    $('#tablaAmbientes tbody').append('<tr><td><img src="../../Img/Ambientes/' + ambiente.IMAGEN + '" alt="" width="100"></td><td>' + ambiente.NOMBRE + '</td><td>' + ambiente.CAPACIDAD + '</td><td>' + ambiente.UBICACION + '</td><td>' + ambiente.PISO + '</td><td>' + ambiente.TIPO + '</td><td>' + ambiente.ESTADO + '</td><td><a href="editarAmbiente.php?id=' + ambiente.ID_AMBIENTE + '" class="btn btn-primary">Editar</a></td></tr>');
                });
            }
        });
    });

    $('#buscarIcono').click(function(){
        $('#buscarForm').submit();
    });
});
</script>

</body>
</html>