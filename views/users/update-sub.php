<?php
include_once '/build/Sidebar.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Somos Hojancha</title>
    <link rel="stylesheet" href="//build/FontFamily_admin_section/fontfamily.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="//build/FontAwesome_6.2.0/FontAwesome_6.2.0.css">
    <link rel="stylesheet" href="//build/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="//build/assets/css/stl_AllCreate.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content-header mb-3" style="background-color: #80D0C7;">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Usuarios</h1>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card" style="border-radius: 7px; background: #F8F8FF;">
                                <div class="card-header" style="background-color: #D6EAF8;">
                                    <h2 class="card-title" style="font-size: 23px;"><strong>Actualizar:</strong> Datos Personales</h2>
                                </div>
                                <form class="form" method="POST" id="regiration_form">
                                    <div class="card-body">
                                        <fieldset>
                                            <div class="row">
                                                <div class="col col-auto">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="nombre">Nombre de usuario</label>
                                                        <input class="form-control" type="text" id="nombre" onKeyUp="javascript:validateText('nombre')" placeholder="Esriba en este espacio" value="<?php echo s($usuario->NombreUser); ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="col col-auto">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="tipo">Provincia</label>
                                                        <select class="form-select" autofocus id="tipo">
                                                            <option selected disabled>Seleccione aquí</option>
                                                            <option value="">Guanacaste</option>
                                                            <option value="">San José</option>
                                                            <option value="">Puntarenas</option>
                                                            <option value="">Heredia</option>
                                                            <option value="">Alajuela</option>
                                                            <option value="">Limón</option>
                                                            <option value="">Cartago</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                            <div class="col col-xxl-6 col-xl-6 col-lg-6 col-sm-6 col-md-6 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="tiposangre">Nombre del titular</label>
                                                    <input  class="form-control" type="text" id="tiposangre" onKeyUp="javascript:validateTextUbi('tiposangre')" placeholder="Escriba aquí el nombre del titular" value="">
                                                </div>
                                                </div>
                                                <div class="col col-xxl-6 col-xl-6 col-lg-6 col-sm-6 col-md-6 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="raza">Número de tarjeta</label>
                                                    <input  class="form-control" type="text" id="raza" onKeyUp="javascript:validateTextUbi('raza')" placeholder="XXXX-XXXX-XXXX-XXXX" value="">
                                                </div>
                                                </div>
                                                <div class="col col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="nombre">Fecha de caducidad</label>
                                                        <input class="form-control" type="date">
                                                    </div>
                                                </div>
                                                <div class="col col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="edad">Código de seguridad</label>
                                                        <input class="form-control" type="int" placeholder="CVC" value="">
                                                    </div>
                                                </div>
                                                <div class="col col-xxl-6 col-xl-6 col-lg-6 col-sm-12 col-md-6 col-12">
                                                    <div class="mb-3">
                                                        <input class="form-control" type="hidden" id="suscripcion" name="usuario[Suscripcion]" value="Premium">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col col-4">
                                                <div class="mb-3">
                                                    <label class="form-label" for="total">Total a pagar</label>
                                                    <label style="background-color: #D9D9D9;" class="form-control" for="total">$30</label>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="card-footer">
                                        <div class="btn-spinner">
                                            <a type="button" class="btn btn-outline-danger col-auto me-2 col-xl-2 col-lg-2 col-md-2 col-sm-3 mt-1 mb-1" href="/users/index"> <i class="fas fa-times-circle"></i> <b>Cerrar</b> </a>
                                            <button type="submit" class="btn btn-outline-dark col-auto me-2 col-xl-2 col-lg-2 col-md-2 col-sm-3 mt-1 mb-1" id="submit_data"> <b>Pagar</b> <i class="fas fa-money-check" style="color:#008f39;"></i> </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script src="//build/assets/js/stl_AllCreate.js"></script>
    <script src="//build/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="//build/jquery/jquery-3.3.1.min.js"></script>
    <script type="text/javascript">
        //-----VER CONTRASEÑA inicio-----------------------------------------------------------|
        window.addEventListener("load", function() {

            // icono para poder interaccionar con el elemento
            showPassword = document.querySelector('.show-password');
            showPassword.addEventListener('click', () => {

                // elementos input de tipo password
                password1 = document.querySelector('.password1');
                password2 = document.querySelector('.password2');

                if (password1.type === "text") {
                    password1.type = "password"
                    password2.type = "password"
                    showPassword.classList.remove('fa-eye-slash');
                } else {
                    password1.type = "text"
                    password2.type = "text"
                    showPassword.classList.toggle("fa-eye-slash");
                }
            })
        });
        //-----VER CONTRASEÑA fin-----------------------------------------------------------|y
        const btnGuardar = document.getElementById('submit_data');
        const formulario = document.getElementById('regiration_form');

        btnGuardar.addEventListener('click', (event) => {
            event.preventDefault();

            Swal.fire({
                title: '¿Quiere guardar los cambios?',
                showDenyButton: true,
                confirmButtonText: 'Guardar',
                denyButtonText: 'No guardar',
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-success mr-3',
                    denyButton: 'btn btn-danger',
                },
                preConfirm: () => {
                    return new Promise((resolve) => {
                        Swal.showLoading();

                        setTimeout(() => {
                            resolve();
                        }, 1000);
                    });
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: '¡Datos guardados!',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'OK',
                        buttonsStyling: false,
                        customClass: {
                            confirmButton: 'btn btn-success',
                        },
                    }).then(() => {
                        formulario.addEventListener('submit', () => {
                            Swal.close();
                        });

                        formulario.submit();
                    });
                } else if (result.isDenied) {
                    Swal.fire({
                        title: '¡Datos no guardados!',
                        icon: 'info',
                        showCancelButton: false,
                        confirmButtonText: 'OK',
                        buttonsStyling: false,
                        customClass: {
                            confirmButton: 'btn btn-success',
                        },
                    });
                }
            });
        });
    </script>
</body>

</html>