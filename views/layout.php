<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <link rel="shortcut icon" href="//build/assets/images/LogoS.webp">
    <meta name="image" content="//build/assets/images/LogoS.webp"> -->
    <meta name="description" content="">
    <meta name="author" content="Desarrollado por estudiantes de la Universidad Nacional de Costa Rica">
    <title>BioVet</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&family=Open+Sans&display=swap" rel="stylesheet">
    <link href="/build/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/build/assets/css/bootstrap-icons.css" rel="stylesheet">
    <link href="/build/plugins/templatemo-topic-listing.css" rel="stylesheet">
</head>

<body id="top">
    <main>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <i class="bi-back"></i>
                    <span>BioVet</span>
                </a>

                <div class="d-lg-none ms-auto me-4">
                    <a href="#top" class="navbar-icon bi-person smoothscroll"></a>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-lg-5 me-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_1">Inicio</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_2">Procesos</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_3">Cómo funciona</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_4">Preguntas frecuentes</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_5">Contacto</a>
                        </li>
                    </ul>

                    <li class="nav-item dropdown" style="list-style: none; margin-right: 5px;">
                        <a class="nav-link dropdown-toggle my-2" href="#" id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Usuario</a>

                        <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink">
                            <li><a class="dropdown-item" href="login">Iniciar sesión</a></li>

                            <li><a class="dropdown-item" href="/register">Registrarse</a></li>
                        </ul>
                    </li>
                    </ul>

                    <div class="d-none d-lg-block">
                        <a href="#top" class="navbar-icon bi-person smoothscroll"></a>
                    </div>
                </div>
            </div>
        </nav>


        <?php echo $contenido; ?>
    </main>

    <footer class="site-footer section-padding">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-12 mb-4 pb-2">
                    <a class="navbar-brand mb-2" href="index.html">
                        <i class="bi-back"></i>
                        <span>BioVet</span>
                    </a>
                </div>

                <div class="col-lg-3 col-md-4 col-6">
                    <h6 class="site-footer-title mb-3">Accesos</h6>

                    <ul class="site-footer-links">
                        <li class="site-footer-link-item">
                            <a href="#section_1" class="site-footer-link">Inicio</a>
                        </li>

                        <li class="site-footer-link-item">
                            <a href="#section_2" class="site-footer-link">Procesos</a>
                        </li>
                        <li class="site-footer-link-item">
                            <a href="#section_3" class="site-footer-link">Cómo funciona</a>
                        </li>

                        <li class="site-footer-link-item">
                            <a href="#section_4" class="site-footer-link">Preguntas frecuentes</a>
                        </li>

                        <li class="site-footer-link-item">
                            <a href="#section_5" class="site-footer-link">Contactos</a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-4 col-6 mb-4 mb-lg-0">
                    <h6 class="site-footer-title mb-3">Información</h6>

                    <p class="text-white d-flex mb-1">
                        <a href="tel: 305-240-9671" class="site-footer-link">
                            2659-2628
                        </a>
                    </p>

                    <p class="text-white d-flex">
                        <a href="mailto:info@company.com" class="site-footer-link">
                            Biovet@gmail.com
                        </a>
                    </p>
                </div>

            </div>
        </div>
    </footer>

    <script src="/build/assets/js/jquery.min.js"></script>
    <script src="/build/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/build/assets/js/jquery.sticky.js"></script>
    <script src="/build/assets/js/click-scroll.js"></script>
    <script src="/build/assets/js/custom.js"></script>

</body>

</html>