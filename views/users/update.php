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
            <section class="content-header">
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
                            <div class="card card-success" style="border-radius: 7px; background: #F8F8FF;">
                                <div class="card-header" style="background-color: #13701C;">
                                    <h2 class="card-title" style="font-size: 23px;"><strong>Actualizar:</strong> Datos Personales</h2>
                                </div>
                                <div class="card-body">
                                    <form class="form" method="POST" id="regiration_form">
                                        <fieldset>
                                            <div class="mb-3">
                                                <label class="form-label" for="nombre"><strong>Nombre</strong></label>
                                                <input class="form-control" type="text" id="nombre" name="usuario[Nombre]" onKeyUp="javascript:validateText('nombre')" placeholder="Esriba en este espacio" value="<?php echo s($usuario->Nombre); ?>">
                                                <?php if ($ErrNomb) : ?>
                                                    <div class="alert alert-danger mt-1 p-0" role="alert">
                                                        <?php echo $ErrNomb ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="row">
                                                <div class="col col-xxl-6 col-xl-6 col-lg-6 col-sm-12 col-md-6 col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="apell1"><strong>Primer apellido</strong></label>
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
                                                        <label class="form-label" for="apell2"><strong>Segundo apellido</strong></label>
                                                        <input class="form-control" type="text" id="apell2" name="usuario[Apellido2]" onKeyUp="javascript:validateText('apell2')" placeholder="Escriba en este espacio" value="<?php echo s($usuario->Apellido2); ?>">
                                                        <?php if ($ErrApell) : ?>
                                                            <div class="alert alert-danger mt-1 p-0" role="alert">
                                                                <?php echo $ErrApell ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col col-7 col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="rol"><strong>Rol de usuario</strong></label>
                                                        <select class="form-select" name="usuario[Rol_Id]" id="rol">
                                                            <option disabled selected>Seleccione aquí</option>
                                                            <?php foreach ($resultadorol as $rol) : ?>
                                                                <option <?php echo $usuario->Rol_Id === $rol->Id ? 'selected' : ''; ?> value="<?php echo s($rol->Id); ?>"> <?php echo s($rol->Nombre_Rol); ?> </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <?php if ($ErrRol) : ?>
                                                            <div class="alert alert-danger mt-1 p-0" role="alert">
                                                                <?php echo $ErrRol ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="col col-5 col-sm-3 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="estado"><strong>Estado</strong><span style="color:blue;"> *</span></label>
                                                        <select id="estado" name="usuario[FK_Estado]" class="form-select">
                                                            <option selected disabled>Seleccione aquí</option>
                                                            <?php foreach ($resultadoestado as $estado) : ?>
                                                                <option <?php echo $usuario->FK_Estado === $estado->Id ? 'selected' : ''; ?> value="<?php echo s($estado->Id); ?>" data-inactivo="<?php echo $estado->Estado === 'Inactivo' ? 'true' : 'false'; ?>">
                                                                    <?php echo s($estado->Estado); ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <?php if ($ErrEstado) : ?>
                                                            <div class="alert alert-danger mt-1 p-0" role="alert">
                                                                <?php echo $ErrEstado ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="col col-12 col-sm-5 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="motivo"><strong>Motivo de inactibidad</strong><span style="color:blue;"> *</span></label>
                                                        <textarea class="form-control" id="motivo" rows="3" maxlength="100" style="overflow: hidden; resize: none;" name="usuario[Motivo]" onKeyUp="javascript:validateText('motivo')" placeholder="Escriba el motivo aquí"><?php echo s($usuario->Motivo); ?></textarea>
                                                        <span class="form-text">(Área obligatória para "Estado" Inactivo). <small style="color:red;">*</small> </span>
                                                        <?php if ($ErrMotivo) : ?>
                                                            <div class="alert alert-danger mt-1 p-0" role="alert">
                                                                <?php echo $ErrMotivo ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col col-xxl-12 col-xl-12 col-lg-12 col-sm-6 col-md-12 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="correo"><strong>Correo electrónico</strong></label>
                                                    <input class="form-control" type="email" id="correo" name="usuario[Email]" placeholder="Escriba en este espacio" value="<?php echo s($usuario->Email); ?>">
                                                    <?php if ($ErrEmail) : ?>
                                                        <div class="alert alert-danger mt-1 p-0" role="alert">
                                                            <?php echo $ErrEmail ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <hr style="background-color: green;">
                                            <a class="btn btn-outline-danger col-auto col-xl-auto col-lg-auto col-md-auto col-sm-auto mt-2" href="/users/index"> <i class="fas fa-times-circle"></i> <b>Cerrar</b> </a>
                                            <button type="submit" class="btn btn-outline-dark col-auto col-xl-auto col-lg-auto col-md-auto col-sm-auto mt-2" id="submit_data"> <b>Guardar</b> <i class="fas fa-save"></i> </button>
                                        </fieldset>
                                    </form>
                                </div>
                                <div class="card-footer"></div>
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
        //-----VER CONTRASEÑA fin-----------------------------------------------------------|
        //-----CAMBIO DE ESTADO inicio-----------------------------------------------------------|
        document.addEventListener('DOMContentLoaded', () => {
            // Obtener los elementos HTML
            const estadoSelect = document.querySelector('#estado');
            const motivoTextarea = document.querySelector('#motivo');
            const motivoInput = document.querySelector('#motivo');

            // Función que cambia el estado del campo del motivo
            function actualizarMotivo() {
                // Verificar si el estado anterior era "Inactivo" y el estado actual es "Activo"
                if (estadoSelect.previousValue === '2' && estadoSelect.value === '1') {
                    motivoTextarea.value = ''; // Borrar el contenido del textarea (pone en blanco)
                }

                motivoTextarea.readOnly = estadoSelect.value === '1';
                motivoTextarea.required = estadoSelect.value === '2';
                motivoTextarea.value = estadoSelect.value === '1' ? motivoInput.value : '<?php echo s($usuario->Motivo); ?>';

                // Guarda el valor actual del estado
                estadoSelect.previousValue = estadoSelect.value;
            }

            // Configura el evento de cambio de estado
            estadoSelect.addEventListener('change', actualizarMotivo);

            // Actualiza el estado del campo de motivo al cargar la página
            estadoSelect.previousValue = estadoSelect.value;
            actualizarMotivo();
        });
        //-----CAMBIO DE ESTADO fin-----------------------------------------------------------|
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
                        }, 2000);
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