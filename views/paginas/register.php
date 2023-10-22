<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BioVet</title>
    <!-- <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/all.css'>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css'>
    <link rel="stylesheet" href="/public/build/assets/css/style.css"> -->
    <!-- <link href="/public/build/assets/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="/public/build/assets/css/stl_AllCreate.css">
    <link rel="stylesheet" href="/public/build/sweetalert2@11.1.4/sweetalert2.css">
    <style>
        .btn-spinner {
            position: relative;
            overflow: hidden;
        }

        .btn-spinner .spinner {
            position: absolute;
            top: 50%;
            left: 5px;
            transform: translateY(-50%);
            visibility: hidden;
        }

        .btn-spinner.verificando .spinner {
            visibility: visible;
        }

        .password-icon {
            float: right;
            position: relative;
            margin: -25px 10px 0 0;
            cursor: pointer;
        }
    </style>
</head>

<br><br><br>
<div class="container mt-5 mb-2">
    <form method="POST" action="register" id="regiration_form">
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
                <div class="row">
                    <div class="col col-xxl-6 col-xl-6 col-lg-6 col-sm-12 col-md-6 col-12">
                        <div class="mb-3">
                            <label class="form-label" for="ctrs1">Contraseña</label>
                            <input class="form-control password1" type="password" id="ctrs1" name="usuario[Contrasena]" maxlength="16" onKeyUp="javascript:validatePass('ctrs1')" placeholder="Escriba en este espacio" value="<?php echo s($usuario->Contrasena); ?>">
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
                    <div class="col col-xxl-6 col-xl-6 col-lg-6 col-sm-12 col-md-6 col-12">
                        <div class="mb-3">
                            <label class="form-label" for="ctrs2">Repetir contraseña</label>
                            <input class="form-control password2" type="password" id="ctrs2" name="usuario[Password2]" maxlength="16" onKeyUp="javascript:validatePass('ctrs2')" placeholder="Escriba en este espacio" value="<?php echo s($usuario->Password2); ?>">
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
        <div class="card-footer">
            <div class="btn-spinner">
                <button class="btn btn-info col-auto col-xl-2 col-lg-2 col-md-2 col-sm-3 mt-1 mb-1" type="button" id="submit_data" onclick="enviarFormulario()"> <b>Registrarse</b> <i class="fas fa-save"></i> </button>
            </div>
        </div>
    </form>
</div>


<script src="/public/build/sweetalert2@11.1.4/sweetalert2.js"></script>
<script src="/public/build/assets/js/stl_AllCreateUser.js"></script>
<script src="/public/build/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/public/build/jquery/jquery-3.3.1.min.js"></script>
<?php if (isset($_SESSION['success_message'])) : ?>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        Toast.fire({
            icon: 'success',
            title: '<?php echo $_SESSION['success_message']['title']; ?>',
        });

        <?php unset($_SESSION['success_message']); ?>;
    </script>
<?php endif; ?>