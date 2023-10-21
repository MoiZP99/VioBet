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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="/public/build/FontAwesome_6.2.0/FontAwesome_6.2.0.css">
    <link rel="stylesheet" href="/public/build/bootstrap/css/bootstrap.min.css">
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
                            <div class="card" style="border-radius: 7px; background: #F8F8FF;">
                                <div class="card-header" style="background-color: #D6EAF8;">
                                    <h2 class="card-title" style="font-size: 23px;"><strong>Actualizar:</strong> Datos Personales</h2>
                                </div>
                                <form class="form" method="POST" id="regiration_form">
                                    <div class="card-body">
                                        <fieldset>
                                            <div class="row">
                                                <div class="col col-xxl-4 col-xl-4 col-lg-4 col-sm-12 col-md-6 col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="nombre">Nombre</label>
                                                        <input class="form-control" autofocus type="text" id="nombre" name="usuario[NombreUser]" onKeyUp="javascript:validateText('nombre')" placeholder="Esriba en este espacio" value="<?php echo s($usuario->NombreUser); ?>">
                                                        <?php if ($ErrNomb) : ?>
                                                            <div class="alert alert-danger mt-1 p-0" role="alert">
                                                                <?php echo $ErrNomb ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="col col-xxl-4 col-xl-4 col-lg-4 col-sm-12 col-md-6 col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="correo">Correo electrónico</label>
                                                        <input class="form-control" type="email" id="correo" name="usuario[Email]" placeholder="Escriba en este espacio" value="<?php echo s($usuario->Email); ?>">
                                                        <?php if ($ErrEmail) : ?>
                                                            <div class="alert alert-danger mt-1 p-0" role="alert">
                                                                <?php echo $ErrEmail ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="col col-xxl-4 col-xl-4 col-lg-4 col-sm-12 col-md-6 col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="telefono">Teléfono</label>
                                                        <input class="form-control" type="tel" id="telefono" name="usuario[Telefono]" placeholder="Escriba en este espacio" value="<?php echo s($usuario->Telefono); ?>">
                                                        <?php if ($ErrTelefono) : ?>
                                                            <div class="alert alert-danger mt-1 p-0" role="alert">
                                                                <?php echo $ErrTelefono ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col col-xxl-6 col-xl-6 col-lg-6 col-sm-12 col-md-6 col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="apell1">Primer apellido</label>
                                                        <input class="form-control" type="text" id="apell1" name="usuario[Apellido1]" onKeyUp="javascript:validateText('apell1')" placeholder="Escriba en este espacio" value="<?php echo s($usuario->Apellido1); ?>">
                                                        <?php if ($ErrApel) : ?>
                                                            <div class="alert alert-danger mt-1 p-0" role="alert">
                                                                <?php echo $ErrApel ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="col col-xxl-6 col-xl-6 col-lg-6 col-sm-12 col-md-6 col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="apell2">Segundo apellido</label>
                                                        <input class="form-control" type="text" id="apell2" name="usuario[Apellido2]" onKeyUp="javascript:validateText('apell2')" placeholder="Escriba en este espacio" value="<?php echo s($usuario->Apellido2); ?>">
                                                        <?php if ($ErrApell) : ?>
                                                            <div class="alert alert-danger mt-1 p-0" role="alert">
                                                                <?php echo $ErrApell ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="card-footer">
                                        <div class="btn-spinner">
                                            <a type="button" class="btn btn-outline-danger col-auto me-2 col-xl-2 col-lg-2 col-md-2 col-sm-3 mt-1 mb-1" href="/users/index"> <i class="fas fa-times-circle"></i> <b>Cerrar</b> </a>
                                            <button type="submit" class="btn btn-outline-dark col-auto me-2 col-xl-2 col-lg-2 col-md-2 col-sm-3 mt-1 mb-1" id="submit_data"> <b>Guardar</b> <i class="fas fa-save"></i> </button>
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

    <script src="/public/build/assets/js/stl_AllCreate.js"></script>
    <script src="/public/build/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/public/build/jquery/jquery-3.3.1.min.js"></script>
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