<?php
include_once 'public/build/Sidebar.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Somos Hojancha</title>
    <link rel="stylesheet" href="/public/build/FontFamily_admin_section/fontfamily.css">
    <link rel="stylesheet" href="/public/build/FontAwesome_table_users/fontawesome5.13.0.css">
    <link rel="stylesheet" href="/public/build/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/build/toast/bootstrap-toaster.css">
    <link rel="stylesheet" href="/public/build/assets/css/stl_AllCreate.css">
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
                            <form class="form" method="POST" id="regiration_form">
                                <div class="card" style="border-radius: 7px; background: #F8F8FF;">
                                    <div class="card-header" style="background-color: #D6EAF8;">
                                        <h2 class="card-title" style="font-size: 20px;"><strong>Actualizar:</strong> Contraseña</h2>
                                    </div>
                                    <div class="card-body">
                                        <fieldset>
                                            <div class="row">
                                                <div class="col col-xxl-6 col-xl-6 col-lg-6 col-sm-6 col-md-6 col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="ctrs1">Nueva contraseña</label>
                                                        <input class="form-control password1" type="password" id="ctrs1" name="usuario[Contrasena]" maxlength="16" onKeyUp="javascript:validatePass('ctrs1')" placeholder="Escriba en este espacio">
                                                        <span class="fa fa-fw fa-eye password-icon show-password"></span>
                                                        <span class="form-text" id="contador">De 8 a 16 caracteres.<small style="color:red;"><b>*</b></small> </span>
                                                        <span class="form-text" id="contador">Mínimo 1 letra mayúscula.<small style="color:red;"><b>*</b></small> </span>
                                                        <span class="form-text" id="contador">Mínimo 3 letras minúsculas.<small style="color:red;"><b>*</b></small> </span>
                                                        <span class="form-text" id="contador">Caracteres especiales (#*).<small style="color:red;"><b>*</b></small> </span>
                                                        <?php if ($ErrContraseña) : ?>
                                                            <div class="alert alert-danger mt-1 p-0" role="alert">
                                                                <?php echo $ErrContraseña ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="col col-xxl-6 col-xl-6 col-lg-6 col-sm-6 col-md-6 col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="ctrs2">Repetir contraseña</label>
                                                        <input class="form-control password2" type="password" id="ctrs2" name="usuario[Password2]" maxlength="16" onKeyUp="javascript:validatePass('ctrs2')" placeholder="Escriba en este espacio">
                                                        <?php if ($ErrContraseña) : ?>
                                                            <div class="alert alert-danger mt-1 p-0" role="alert">
                                                                <?php echo $ErrContraseña ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-outline-danger col-auto me-2 col-xl-2 col-lg-2 col-md-2 col-sm-3 mt-1 mb-1" href="/users/index"> <i class="fas fa-times-circle"></i> <b>Cerrar</b> </a>
                            <button type="submit" class="btn btn-outline-dark col-auto me-2 col-xl-2 col-lg-2 col-md-2 col-sm-3 mt-1 mb-1" id="submit_data"> <b>Guardar</b> <i class="fas fa-save"></i> </button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script src="/public/build/assets/js/stl_AllCreate.js"></script>
    <script src="/public/build/toast/bootstrap-toaster.js"></script>
    <script src="/public/build/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/public/build/jquery/jquery-3.3.1.min.js"></script>
    <!-- <script src="/public/build/plugins/bs-stepper/js/bs-stepper.min.js"></script> -->
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
        //-----VER CONTRASEÑA fin-----------------------------------------------------------|
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