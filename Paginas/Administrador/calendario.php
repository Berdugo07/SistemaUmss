<?php
require_once '../../config/validacion_session.php';
require_once '../../config/conexion.php';

$correo = $_SESSION['user'];

$query = "SELECT nombre FROM usuario WHERE correo = '$correo'";
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
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" type="text/css" href="css1/fullcalendar.min.css">
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css1/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css1/home.css">
</head>

<body>

  <header class="headerHU">
    <div class="header-content">
      <div class="header-logo" style="margin-right: 20px;">
        <img src="../../Img/logoFCyT.jpeg" alt="Logo" width="180" height="65">
      </div>
      <div class="vertical-line" style="border-left: 1px solid white; height: 40px; margin-left: 20px;"></div>
      <span class="header-title" style="font-family: 'Courgette', cursive; color: white; margin-left: 60px; margin-right: 100px;">SISTEMA DE RESERVA DE AULAS DE FCyT</span>
      <div class="vertical-line" style="border-left: 1px solid white; height: 40px; margin-left: 60px;"></div>
      <div class="header-links" style="display: flex; align-items: center;">
        <i class="bi bi-bell-fill" style="margin-left: 40px;"></i>
        <i class="bi bi-person-circle" style="margin-left: 50px;"></i>
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: white; margin-left: 50px;">
          <?php echo $nombreUsuario; ?>
        </a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="../../config/controlador_cerrar_sesion.php">Cerrar sesión</a></li>
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
          <a href="#" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse" data-bs-target="#RegistrarA" aria-expanded="false" aria-controls="RegistrodeAmbiente" style="text-decoration: none;">
            <img width="25" height="25" src="https://img.icons8.com/ios-filled/50/plus-2-math.png" alt="plus-2-math" style="filter: invert(100%); margin-right: 10px;" />
            <span>REGISTRO AMBIENTES</span>
          </a>
          <ul id="RegistrarA" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
            <li class="sidebar-item">
              <a href="RegistrodeAmbiente.php" class="sidebar-link" data-bs-target="#staticBackdrop2" style="text-decoration: none;">REGISTRO DE AMBIENTE</a>
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
            <img width="25" height="25" src="https://img.icons8.com/ios-filled/50/add-user-male.png" alt="plus-2-math" style="filter: invert(100%); margin-right: 10px;" />
            <span>REGISTRAR USUARIO</span>
          </a>
          <ul id="RegistrarU" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
            <li class="sidebar-item">
              <a href="./registrar_usuario.php" class="sidebar-link" data-bs-target="#staticBackdrop2" style="text-decoration: none;">REGISTRAR UN SOLO USUARIO</a>
            </li>
            <li class="sidebar-item">
              <a href="./formulario_csv.php" class="sidebar-link" style="text-decoration: none;">REGISTRAR VARIOS USUARIOS</a>
            </li>
          </ul>
        </li>
        <li class="sidebar-item">
          <a href="#" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse" data-bs-target="#Reserva" aria-expanded="false" aria-controls="Reserva" style="text-decoration: none;">
            <img width="25" height="25" src="https://img.icons8.com/ios-filled/50/reservation-2.png" alt="reservation-2" style="filter: invert(100%); margin-right: 10px;" />
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
            <img width="25" height="25" src="https://img.icons8.com/ios-filled/50/classroom.png" alt="classroom" style="filter: invert(100%); margin-right: 10px;" />
            <span>AMBIENTES DISPONIBLES</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a href="./calendario.php" class="sidebar-link" style="text-decoration: none;">
            <img width="25" height="25" src="https://img.icons8.com/ios-filled/50/calendar--v1.png" alt="CALENDAR" style="filter: invert(100%); margin-right: 10px;" />
            <span>CALENDARIO</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a href="modificar_usuario.php" class="sidebar-link" style="text-decoration: none;">
            <img width="25" height="25" src="https://img.icons8.com/fluency-systems-filled/48/edit-user.png" alt="USERMODIFICAR" style="filter: invert(100%); margin-right: 10px;" />
            <span>MODIFICAR CUENTA DE USUARIO</span>
          </a>
        </li>
      </ul>
    </aside>
    <div class="main p-3">
      <?php
      include('config.php');

      $SqlEventos = ("SELECT * FROM eventoscalendar");
      $resulEventos = mysqli_query($con, $SqlEventos);
      ?>
      <div class="mt-5"></div>

      <div class="container">
        <div class="row">
          <div class="col msjs">
            <?php include('msjs.php'); ?>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 mb-3">
            <h3 class="text-center" id="title">CALENDARIO ACADEMICO FCyT UMSS</h3>
          </div>
        </div>
      </div>
      <div id="calendar"></div>
      <?php
  include('modalNuevoEvento.php');
  include('modalUpdateEvento.php');
  ?>
    </div>
  </div>

   <script src="js1/jquery-3.0.0.min.js"></script>
  <script src="js1/popper.min.js"></script>
  <script src="js1/bootstrap.min.js"></script>
  <script type="text/javascript" src="js1/moment.min.js"></script>
  <script type="text/javascript" src="js1/fullcalendar.min.js"></script>
  <script src='locales/es.js'></script>

  <script type="text/javascript">
    $(document).ready(function () {
      $("#calendar").fullCalendar({
        header: {
          left: "prev,next today",
          center: "title",
          right: "month,agendaWeek,agendaDay"
        },
        locale: 'es',
        defaultView: "month",
        navLinks: true,
        editable: true,
        eventLimit: true,
        selectable: true,
        selectHelper: false,

        // Nuevo Evento
        select: function (start, end) {
          $("#exampleModal").modal();
          $("input[name=fecha_inicio]").val(start.format('DD-MM-YYYY'));

          var valorFechaFin = end.format("DD-MM-YYYY");
          var F_final = moment(valorFechaFin, "DD-MM-YYYY").subtract(1, 'days').format('DD-MM-YYYY'); // Le resto 1 día
          $('input[name=fecha_fin').val(F_final);
        },

        events: [
          <?php while ($dataEvento = mysqli_fetch_array($resulEventos)) { ?> {
            _id: '<?php echo $dataEvento['id']; ?>',
            title: '<?php echo $dataEvento['evento']; ?>',
            start: '<?php echo $dataEvento['fecha_inicio']; ?>',
            end: '<?php echo $dataEvento['fecha_fin']; ?>',
            color: '<?php echo $dataEvento['color_evento']; ?>'
          },
          <?php } ?>
        ],

        // Eliminar Evento
        eventRender: function (event, element) {
          element
            .find(".fc-content")
            .prepend("<span id='btnCerrar' class='closeon material-icons'>&#xe5cd;</span>");

          // Eliminar evento
          element.find(".closeon").on("click", function () {
            var pregunta = confirm("¿Deseas Borrar este Evento?");
            if (pregunta) {
              $("#calendar").fullCalendar("removeEvents", event._id);
              $.ajax({
                type: "POST",
                url: 'deleteEvento.php',
                data: { id: event._id },
                success: function (datos) {
                  $(".alert-danger").show();
                  setTimeout(function () {
                    $(".alert-danger").slideUp(500);
                  }, 3000);
                }
              });
            }
          });
        },

        // Moviendo Evento Drag - Drop
        eventDrop: function (event, delta) {
          var idEvento = event._id;
          var start = (event.start.format('DD-MM-YYYY'));
          var end = (event.end ? event.end.format("DD-MM-YYYY") : start); // Check for null end date

          $.ajax({
            url: 'drag_drop_evento.php',
            data: 'start=' + start + '&end=' + end + '&idEvento=' + idEvento,
            type: "POST",
            success: function (response) {
              // $("#respuesta").html(response);
            }
          });
        },

        // Modificar Evento del Calendario 
        eventClick: function (event) {
          var idEvento = event._id;
          $('input[name=idEvento').val(idEvento);
          $('input[name=evento').val(event.title);
          $('input[name=fecha_inicio]').val(event.start.format('DD-MM-YYYY'));
          $('input[name=fecha_fin]').val(event.end ? event.end.format('DD-MM-YYYY') : event.start.format('DD-MM-YYYY')); // Check for null end date

          $("#modalUpdateEvento").modal();
        },
      });

      // Oculta mensajes de Notificación
      setTimeout(function () {
        $(".alert").slideUp(300);
      }, 3000);
    });
  </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="../../js/MenuLateral.js"></script>
</body>

</html>
