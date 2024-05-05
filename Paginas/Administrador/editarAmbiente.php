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


$id = $_GET['id'];

// Consultar la base de datos para obtener los detalles del ambiente con el ID proporcionado
$stmt = $conexion->prepare("SELECT * FROM ambientes WHERE id = :id");
$stmt->bindParam(":id", $id);
$stmt->execute();
$ambiente = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Procesar los datos del formulario y actualizar el registro en la base de datos
    $nombre = $_POST['nombre'];
    $capacidad = $_POST['capacidad'];
    $ubicacion = $_POST['ubicacion'];
    $piso = $_POST['piso'];
    $periodo = $_POST['periodo'];
    $fechaInicio = $_POST['fechaInicio'];
    $fechaFin = $_POST['fechaFin'];
    $horarios = implode(',', $_POST['horarios']);

    // Actualizar el registro en la base de datos
    $stmt = $conexion->prepare("UPDATE ambientes SET ubicacion = :ubicacion, piso= :piso, periodo = :periodo, fechaInicio = :fechaInicio, fechaFin = :fechaFin , horarios =:horarios WHERE id = :id");
    $stmt->bindParam(":ubicacion", $ubicacion);
    $stmt->bindParam(":piso", $piso);
    $stmt->bindParam(":periodo", $periodo);
    $stmt->bindParam(":fechaInicio", $fechaInicio);
    $stmt->bindParam(":fechaFin", $fechaFin);
    $stmt->bindParam(":horarios", $horarios);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    echo "<script>
            window.location.href = 'listaDeAmbientesRegistrados.php'; // Redirigir a la lista de ambientes
          </script>";
    exit(); 
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Ambiente</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="editarAmbiente.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <style>
        
        .container {
            margin-top: 50px; 
        }
        .form-control {
            margin-bottom: 20px;
        }
       
        .scroll-container {
            max-height: 700px; 
            overflow-y: auto;
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
                <a href="" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse" data-bs-target="#RegistrarA" aria-expanded="false" aria-controls="RegistrarA" style="text-decoration: none;">
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
                <a href="modificar_usuario" class="sidebar-link" style="text-decoration: none;">
                    <img width="25" height="25" src="https://img.icons8.com/fluency-systems-filled/48/edit-user.png" alt="USERMODIFICAR" style="filter: invert(100%);margin-right: 10px;" />
                    <span>MODIFICAR CUENTA DE USUARIO</span>
                </a>
            </li>
        </ul>
    </aside>



    <div class="main p-3" style="max-width: 600px; margin: 0 auto; font-size: 18px;">
    <h2>Editar Ambiente</h2>
    <div class="scroll-container">
        <div class="form-container">
            <form action="" method="post">
            <div class="form-row">
                <label for="nombre">Nombre:</label>
                <span><input type="text" id="nombre" class="form-control"  name="nombre" value="<?php echo $ambiente['nombre']; ?>"readonly>
            </div>

            <div class="form-row">
                <label for="capacidad">Capacidad:</label>
                <input type="text" id="capacidad" class="form-control"  name="capacidad" value="<?php echo $ambiente['capacidad']; ?>"readonly>
            </div>
            
            <div class="form-row">
                <label for="ubicacion">Ubicación:</label>
                <input type="text" id="ubicacion" class="form-control"  name="ubicacion" value="<?php echo $ambiente['ubicacion']; ?>">
            </div>

           
            <div class="form-input">
                        <label for="piso">Piso</label>
                        <select class="form-control" id="piso" name="piso" value="<?php echo $ambiente['piso']; ?>" required>
                            <option value="1">1er Piso</option>
                            <option value="2">2do Piso</option>
                            <option value="3">3er Piso</option>
                            <!-- Agrega más opciones si es necesario -->
                        </select>
                    </div>
            <div class="form-row">
                <label for="periodo">Periodo de examen:</label>
                <select id="periodo" class="form-control" name="periodo">
                    <option value="primer parcial" <?php if($ambiente['periodo'] == 'primer parcial') echo 'selected'; ?>>Primer Parcial</option>
                    <option value="segundo parcial" <?php if($ambiente['periodo'] == 'segundo parcial') echo 'selected'; ?>>Segundo Parcial</option>
                    <option value="tercer parcial" <?php if($ambiente['periodo'] == 'tercer parcial') echo 'selected'; ?>>Examen Final</option>
                    
                </select>
            </div>
        
        
        
            <div class="form-group">
    <label for="fechaInicio">Fecha de inicio</label>
    <input type="date" class="form-control" id="fechaInicio" name="fechaInicio" min="<?php echo date('Y-m-d'); ?>" value="<?php echo $ambiente['fechaInicio']; ?>"required>
</div>
<div class="form-group">
    <label for="fechaFin">Fecha de fin</label>
    <input type="date" class="form-control" id="fechaFin" name="fechaFin" value="<?php echo $ambiente['fechaFin']; ?>"required>
</div>
            <div class="form-row">
                <label for="horarios">Horario:</label>
                <select id="horarios" class="form-control" name="horarios[]" multiple>
                <?php
        // Obtener los horarios del ambiente seleccionado
        $horarios_ambiente = explode(',', $ambiente['horarios']);

        // Mostrar horarios disponibles en la lista desplegable
        $horarios_disponibles = array(
            "06:45", "08:15", "09:45", "11:15", "12:45",
            "14:15", "15:45", "17:15", "18:45", "20:15"
        );

        foreach ($horarios_disponibles as $horario) {
            $selected = in_array($horario, $horarios_ambiente) ? 'selected' : '';
            echo "<option value='$horario' $selected>$horario</option>";
        }
        ?>
                    <option value="06:45">06:45</option>
                    <option value="08:15">08:15</option>
                    <option value="09:45">09:45</option>
                    <option value="11:15">11:15</option>
                    <option value="12:45">12:45</option>
                    <option value="14:15">14:15</option>
                    <option value="15:45">15:45</option>
                    <option value="17:15">17:15</option>
                    <option value="18:45">18:45</option>
                    <option value="20:15">20:15</option>

                </select>
            </div>
        
            
            <div class="form-row">
    <div class="col d-flex justify-content-center">
    <button type="submit" class="btn btn-primary" style="height: 40px; margin-top:6px;">GUARDAR CAMBIOS</button>
<a href="listaDeAmbientesRegistrados.php" class="btn btn-danger mt-2 ms-2" style="height: 40px;">CANCELAR</a>

    </div>
</div>

<script>
document.getElementById('fechaInicio').addEventListener('change', function() {
    var fechaInicio = this.value;
    document.getElementById('fechaFin').setAttribute('min', fechaInicio);
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="../../js/MenuLateral.js"></script>
</body>
</html>
