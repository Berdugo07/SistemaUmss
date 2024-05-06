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

// Consultar la base de datos para obtener los estados
$stmtEstado = $conexion->prepare("SELECT * FROM estado");
$stmtEstado->execute();
$estados = $stmtEstado->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Procesar los datos del formulario y actualizar el registro en la base de datos
    $nombre = $_POST['nombre'];
    $capacidad = $_POST['capacidad'];
    $ubicacion = $_POST['ubicacion'];
    $piso = $_POST['piso'];
    $fecha = $_POST['fecha'];
    $descripcion = $_POST['descripcion'];
    $estado = $_POST['estado'];

    // Actualizar el registro en la base de datos
    $stmt = $conexion->prepare("UPDATE ambientes SET ubicacion = :ubicacion, piso= :piso, fecha = :fecha, descripcion = :descricion, estado =:estado WHERE id = :id");
    $stmt->bindParam(":ubicacion", $ubicacion);
    $stmt->bindParam(":piso", $piso);
    $stmt->bindParam(":fecha", $fecha);
    $stmt->bindParam(":descricion", $descripcion);
    $stmt->bindParam(":estado", $estado);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    echo "<script>
            alert('¡Ambiente editado! Los cambios han sido guardados exitosamente.');
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
        .btn-primary {
            margin-top: 20px; 
        }
        .scroll-container {
            max-height: 70vh; 
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
        <h2 id="edit-title">Editar Ambiente</h2>
            <div class="scroll-container">
                <div class="form-container">
                    <form action="" method="post">
                    <div class="form-row">
                        <label for="nombre">Nombre:</label>
                        <span><input type="text" id="nombre" name="nombre" value="<?php echo $ambiente['nombre']; ?>"readonly>
                    </div>

                    <div class="form-row">
                        <label for="capacidad">Capacidad:</label>
                        <input type="text" id="capacidad" name="capacidad" value="<?php echo $ambiente['capacidad']; ?>"readonly>
                    </div>
                    
                    <div class="form-row">
                        <label for="ubicacion">Ubicación:</label>
                        <input type="text" id="ubicacion" name="ubicacion" value="<?php echo $ambiente['ubicacion']; ?>">
                    </div>

                    <div class="form-row">
                        <label for="piso">Piso:</label>
                        <input type="text" id="piso" name="piso" value="<?php echo $ambiente['piso']; ?>">
                    </div>
                
                
                    <div class="form-row">
                        <label for="fecha">Fecha:</label>
                        <input type="date" id="fecha" name="fecha" value="<?php echo $ambiente['fecha']; ?>">
                    </div>

                    <div class="form-row">
                        <label for="descripcion">Descripcion:</label>
                        <input type="text" id="descripcion" name="descripcion" value="<?php echo isset($ambiente['descripcion']) ? $ambiente['descripcion'] : ''; ?>">
                    </div>

                
                    <div class="form-row">
                        <label for="estado">Estado:</label>
                        <select id="estado" name="estado">
                            <?php foreach ($estados as $estado) { ?>
                                <option value="<?php echo $estado['id']; ?>" <?php if($ambiente['estado'] == $estado['nombre']) echo 'selected'; ?>><?php echo $estado['nombre']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-row">
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>   
                     
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="confirmation-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">¡Cambios guardados!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Los cambios han sido guardados exitosamente.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="../../js/MenuLateral.js"></script>
<script>
        // Espera a que el DOM esté completamente cargado
        document.addEventListener("DOMContentLoaded", function() {
            // Obtén el botón "Guardar Cambios"
            var guardarCambiosBtn = document.getElementById("guardar-cambios-btn");

            // Agrega un evento de clic al botón
            guardarCambiosBtn.addEventListener("click", function() {
                // Muestra el modal de confirmación
                var myModal = new bootstrap.Modal(document.getElementById('confirmation-modal'));
                myModal.show();
            });
        });
</script>
</body>
</html>
