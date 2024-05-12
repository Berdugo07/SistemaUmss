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
                    <a href="" class="sidebar-link" style="text-decoration: none;">
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
            <div id="carouselExampleIndicators" class="carousel slide">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="Img/Foto1.jpeg" class="d-block img-fluid w-100" style="max-height: 90vh;">
                    </div>
                    <div class="carousel-item">
                        <img src="Img/Foto1.jpeg" class="d-block img-fluid w-100"  style="max-height: 90vh;">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
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

     
    <script src="js/MenuLateral.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>

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
    </script>
</body>

</html>
