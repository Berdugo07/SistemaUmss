<?php

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

//obtener los detalles del ambiente con el ID proporcionado
$stmt = $conexion->prepare("SELECT * FROM ambientes WHERE id = :id");
$stmt->bindParam(":id", $id);
$stmt->execute();
$ambiente = $stmt->fetch(PDO::FETCH_ASSOC);


//obtener los estados
$stmtEstado = $conexion->prepare("SELECT * FROM estado");
$stmtEstado->execute();
$estados = $stmtEstado->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $capacidad = $_POST['capacidad'];
    $ubicacion = $_POST['ubicacion'];
    $piso = $_POST['piso'];
    $fecha = $_POST['fecha'];
    $tipo = $_POST['tipo'];
    $estado = $_POST['estado'];

    // Actualizar el registro en la bds
    $stmt = $conexion->prepare("UPDATE ambientes SET ubicacion = :ubicacion, piso= :piso, fecha = :fecha, tipo = :tipo, estado =:estado WHERE id = :id");
    $stmt->bindParam(":ubicacion", $ubicacion);
    $stmt->bindParam(":piso", $piso);
    $stmt->bindParam(":fecha", $fecha);
    $stmt->bindParam(":tipo", $tipo);
    $stmt->bindParam(":estado", $estado);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    header("Location: listaDeAmbientesRegistrados.php");
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
                    <img width="25" height="25" src="https://img.icons8.com/ios/50/FFFFFF/requirement.png" alt="requirement"/>
                    <span>SOLICITUDES DE RESERVAS</span>
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
                        <label for="tipo">Tipo:</label>
                        <input type="text" id="tipo" name="tipo" value="<?php echo $ambiente['tipo']; ?>">
                    
                    </div>

                
                    <div class="form-row">
                        <label for="estado">Estado:</label>
                        <select id="estado" name="estado">
                            <?php foreach ($estados as $estado) { ?>
                                <option value="<?php echo $estado['id']; ?>" <?php if($ambiente['estado'] == $estado['nombre']) echo 'selected'; ?>><?php echo $estado['nombre']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-row d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary btn-block" onclick="cancelar()">Cancelar</button>
                        <button type="submit" class="btn btn-primary btn-block">Guardar Cambios</button>
                    </div>
                    
                    
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="../../js/MenuLateral.js"></script>

<script>
    function cancelar() {
        window.history.back();
    }
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var formulario = document.querySelector("form");
        formulario.addEventListener("submit", function(event) {
            event.preventDefault();
            if (validarCampos()) {
                swal({
                    title: "Error",
                    text: "Complete todos los datos requeridos.",
                    icon: "error",
                    button: "Aceptar"
                });
            } else {
                swal({
                    title: "¡Cambios guardados!",
                    text: "Los cambios han sido guardados exitosamente.",
                    icon: "success",
                    button: "Aceptar"
                }).then(function() {
                    formulario.submit();
                });
            }
        });

        function validarCampos() {
            var camposVacios = false;
            var campos = formulario.querySelectorAll("input[type='text'], input[type='date'], select");
            campos.forEach(function(campo) {
                if (campo.value.trim() === '') {
                    camposVacios = true;
                }
            });
            return camposVacios;
        }
    });
</script>

</body>
</html>
