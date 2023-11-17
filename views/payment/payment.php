<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BioVet</title>
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
                        <h1>Pago de subscripción</h1>
                        <div class="mb-3">
                            <label class="form-label" for="nombre">Nombre del titular</label>
                            <input class="form-control" autofocus type="text" id="nombre" name="usuario[NombreUser]" onKeyUp="javascript:validateText('nombre')" placeholder="Esriba el nombre del titular" value="">
                        </div>
                    </div>
                    <div class="col col-xxl-4 col-xl-4 col-lg-4 col-sm-12 col-md-6 col-12">
                        <div class="mb-3">
                            <label class="form-label" for="correo">Número de tarjeta</label>
                            <input class="form-control" type="email" id="correo" name="usuario[Email]" placeholder="Ingrese el número de tarjeta" value="">
                        </div>
                    </div>
                    <div class="col col-xxl-4 col-xl-4 col-lg-4 col-sm-12 col-md-6 col-12">
                        <div class="mb-3">
                            <label class="form-label" for="telefono">Fecha de caducidad</label>
                            <input class="form-control" type="date" id="telefono" name="usuario[Telefono]" placeholder="Escriba en este espacio" value="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-xxl-6 col-xl-6 col-lg-6 col-sm-12 col-md-6 col-12">
                        <div class="mb-3">
                            <label class="form-label" for="apell1">Código de seguridad</label>
                            <input class="form-control" type="text" id="apell1" name="usuario[Apellido1]" onKeyUp="javascript:validateText('apell1')" placeholder="Escriba en este espacio" value="">
                        </div>
                    </div>
                    <div class="col col-xxl-6 col-xl-6 col-lg-6 col-sm-12 col-md-6 col-12">
                        <div class="mb-3">
                            <label class="form-label" for="apell2">Tipo de subscripción</label>
                            <input class="form-control" type="text" id="apell2" name="usuario[Apellido2]" onKeyUp="javascript:validateText('apell2')" placeholder="Escriba en este espacio" value="">
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="card-footer">
            <div class="btn-spinner">
                <button class="btn btn-info col-auto col-xl-2 col-lg-2 col-md-2 col-sm-3 mt-1 mb-1" type="button" id="submit_data" onclick="enviarFormulario()"> <b>Subcribirse</b> <i class="fas fa-save"></i> </button>
            </div>
        </div>
    </form>
</div>


<script src="/public/build/sweetalert2@11.1.4/sweetalert2.js"></script>
<script src="/public/build/assets/js/stl_AllCreateUser.js"></script>
<script src="/public/build/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/public/build/jquery/jquery-3.3.1.min.js"></script>
<!--
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