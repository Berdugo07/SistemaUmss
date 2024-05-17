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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>
        #buscarForm {
        display: flex;
        align-items: center;
        }

        #buscarIcono {
            font-size: 1.2em;
            margin-left: 5px;
            cursor: pointer;

        }
        #filtroForm {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        #filtroForm label {
            margin-right: 10px;
        }

        #filtros form {
            margin-right: 10px;
        }

        #filtros {
            display: flex;
            align-items: center;
            justify-content: flex-start; /* Alinea los elementos a la izquierda */
            margin-bottom: 20px; /* Agrega un margen inferior para separarlos de la tabla */
        }

        #filtros select, #filtros label {
            margin-right: 10px; /* Ajusta el espacio entre los elementos */
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
                <div class="container text-center" style="height: 400px; overflow-y: auto;">
                    <h2 class="lista-title">SOLICITUD DE RESERVAS DE AMBIENTES</h2>
                    <div id="filtrosContainer" style="display: flex; align-items: center; margin-bottom: 20px;">
                    <!-- Filtros -->
                        <div id="filtros" style="display: flex; align-items: center;">
                            <!-- Filtro de orden -->
                            <label for="ordenarSelect">Ordenar:</label>
                            <select id="ordenarSelect" name="ordenar">
                                <option value="asc">Ascendente</option>
                                <option value="desc">Descendente</option>
                            </select>
                                
                            <label for="fechasSelect">Filtrar por fecha:</label>
                            <select id="fechasSelect" name="fechas">
                                <option value="hoy">Hoy</option>
                                <option value="semana">Hace una semana</option>
                                <option value="mes">Hace un mes</option>
                            </select>
                        </div>
                    

                        <form id="buscarForm" method="GET" style="margin-left: auto; margin-right: 20px; width: 300px;">
                            <input type="text" name="busqueda" placeholder="Buscar por piso, estado o capacidad" style="width: 100%;">
                            <button type="submit" style="display: none;"></button> 
                            <i class="bi bi-search" id="buscarIcono"></i>
                        </form>
                    </div>

                    <table id="tablaSolicitudes" class="table table-striped">
                        <thead>
                        <tr>
                                <th>Nombre</th>
                                <th>Capacidad</th>
                                <th>Fecha</th>
                                <th>Horario</th>
                                <th>Docente</th>
                                <th>Grupo</th>
                                <th>Materia</th>
                                <th>Accion</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $ambientes_sql=mysqli_query($conexion,"Select * from ambientes");
                            while ($ambientes=mysqli_fetch_array($ambientes_sql)){
                                ?>    
                                <tr>
                                    <td><?php echo $ambientes[1]; ?></td>
                                    <td><?php echo $ambientes[2]; ?></td>
                                    <td><?php echo $ambientes[3]; ?></td>
                                    <td><?php echo $ambientes[4]; ?></td>
                                    <td><?php echo $ambientes[5]; ?></td>
                                    <td><?php echo $ambientes[6]; ?></td>
                                    <td><?php echo $ambientes[7]; ?></td>
                                                        
                                    <td>
                                        <a href='Solicitud.php?id=<?php echo $ambientes['id']; ?>' class='btn btn-primary'>Aceptar</a>
                                        <a href='Solicitud.php?id=<?php echo $ambientes['id']; ?>' class='btn btn-primary'>Rechazar</a>
                                    </td>
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
                url: 'busqueda.php',
                data: formData,
                dataType: 'json',
                success: function(data){
                    $('#tablaSolicitudes tbody').empty();
                    $.each(data, function(index, solicitudes){

                        $('#tablaSolicitudes tbody').append('<tr><td><img src="../../Img/Ambientes/' + ambiente.imagen + '" alt="" width="100"></td><td>' + ambiente.nombre + '</td><td>' + ambiente.capacidad + '</td><td>' + ambiente.ubicacion + '</td><td>' + ambiente.piso + '</td><td>' + ambiente.fecha + '</td><td>' + ambiente.descripcion + '</td><td>' + ambiente.estado + '</td><td><a href="editarAmbiente.php?id=' + ambiente.id + '" class="btn btn-primary">Editar</a></td></tr>');
                    });
                }
            });
        });

        $('#resetButton').click(function(){
            $('#buscarForm')[0].reset();
            $.ajax({
                type: 'GET',
                url: 'buscar.php',
                dataType: 'json',
                success: function(data){
                    $('#tablaSolicitudes tbody').empty();
                    $.each(data, function(index, ambiente){
                        $('#tablaSolicitudes tbody').append('<tr><td>' + ambiente.nombre + '</td><td>' + ambiente.capacidad + '</td><td>' + ambiente.fecha + '</td><td>' + ambiente.horario + '</td><td>' + ambiente.docente + '</td></tr>'+ '</td><td>' + ambiente.fecha + '</td><td>' + ambiente.grupo + '</td><td>' + '</td><td>' + ambiente.materia + '</td><td>' );
                    });

                }
            });
        });
    });
</script>

</body>
</html>