<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Menu de navegacion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>
    <nav class="navbar bg-body-terteary fixed-top">
        <div class="container-fluid">
            <img src="Img/Logo-fcyt.png" class="navbar-brand me-auto">
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    
                    <img src="Img/Logo-fcyt.png" class="offcanvas-title">
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
                        
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2 " href="#">Perfil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2 " href="#">Configuracion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2 " href="#">Cerrar sesion</a>
                        </li>
                        
                    </ul>

                </div>
            </div>
            
            <button class="navbar-toggler pe-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


