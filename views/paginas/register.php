<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BioVet</title>
    <link rel="stylesheet" href="/build/assets/css/stl_AllCreate.css">
    <link rel="stylesheet" href="/build/sweetalert2@11.1.4/sweetalert2.css">
    <script defer src="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.0/js/all.min.js"></script>
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
            margin: 0px 0px 0 0;
            cursor: pointer;
        }

        body {
            background-color: #f8f9fa;
        }

        .form {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .form h2 {
            text-align: center;
            color: #007bff;
            background-color: #e9ecef;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>

<br><br><br>
<div class="container form mt-5 mb-2">
    <h2>Registro de Usuario</h2>
    <div class="card">
        <form method="POST" action="register" id="regiration_form">
            <div class="card-body">
                <fieldset>
                    <div class="row">
                        <div class="col col-12">
                            <div class="mb-3">
                                <label class="form-label" for="nombre">Nombre</label>
                                <input required class="form-control" autofocus type="text" id="nombre" name="usuario[NombreUser]" onKeyUp="javascript:validateText('nombre')" placeholder="Esriba aquí el nombre" value="<?php echo s($usuario->NombreUser); ?>">
                                <?php if ($ErrNomb) : ?>
                                    <div class="alert alert-danger mt-1 p-0" role="alert">
                                        <?php echo $ErrNomb ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col col-12">
                            <div class="mb-3">
                                <label class="form-label" for="apell1">Primer apellido</label>
                                <input required class="form-control" type="text" id="apell1" name="usuario[Apellido1]" onKeyUp="javascript:validateText('apell1')" placeholder="Escriba aquí el primer apellido" value="<?php echo s($usuario->Apellido1); ?>">
                                <?php if ($ErrApel) : ?>
                                    <div class="alert alert-danger mt-1 p-0" role="alert">
                                        <?php echo $ErrApel ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col col-12">
                            <div class="mb-3">
                                <label class="form-label" for="apell2">Segundo apellido</label>
                                <input required class="form-control" type="text" id="apell2" name="usuario[Apellido2]" onKeyUp="javascript:validateText('apell2')" placeholder="Escriba aquí el segundo apellido" value="<?php echo s($usuario->Apellido2); ?>">
                                <?php if ($ErrApell) : ?>
                                    <div class="alert alert-danger mt-1 p-0" role="alert">
                                        <?php echo $ErrApell ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col col-12">
                            <div class="mb-3">
                                <label class="form-label" for="telefono">Número de teléfono</label>
                                <input required class="form-control" type="tel" id="telefono" name="usuario[Telefono]" placeholder="Escriba aquí el # teléfono" value="<?php echo s($usuario->Telefono); ?>">
                                <?php if ($ErrTelefono) : ?>
                                    <div class="alert alert-danger mt-1 p-0" role="alert">
                                        <?php echo $ErrTelefono ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col col-12">
                            <div class="mb-3">
                                <label class="form-label" for="correo">Correo electrónico</label>
                                <input required class="form-control" type="email" id="correo" name="usuario[Email]" placeholder="Escriba aquí el correo electrónico" value="<?php echo s($usuario->Email); ?>">
                                <?php if ($ErrEmail) : ?>
                                    <div class="alert alert-danger mt-1 p-0" role="alert">
                                        <?php echo $ErrEmail ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col col-12">
                            <div class="mb-3">
                                <label class="form-label" for="Contrasena">Contraseña</label>
                                <div class="input-group">
                                    <input required class="form-control password1" type="password" id="Contrasena" name="usuario[Contrasena]" maxlength="16" onkeyup="validatePass()" placeholder="Escriba aquí la contraseña" value="<?php echo s($usuario->Contrasena); ?>">
                                    <span class="input-group-text" id="ContrasenaPrepend" title="Ver"><i class="far fa-fw fa-eye password-icon show-password" style="color:#0D6EFD;" onclick="togglePasswordVisibility()"></i></span>
                                </div>
                                <div class="error-message form-text" id="errorPass"></div>
                                <span class="form-text" id="uno">De 8 a 16 caracteres.<span style="color:red;"><b>*</b></span> /</span>
                                <span class="form-text" id="dos">Mínimo 1 letra mayúscula.<span style="color:red;"><b>*</b></span> /</span>
                                <span class="form-text" id="tres">Mínimo 3 letras minúsculas.<span style="color:red;"><b>*</b></span> /</span>
                                <span class="form-text" id="cuatro">Caracteres especiales (#*).<span style="color:red;"><b>*</b></span> /</span>
                                <span class="form-text" id="cinco">Mínimo 3 números.<span style="color:red;"><b>*</b></span> </span>
                                <?php if ($ErrContraseña) : ?>
                                    <div class="alert alert-danger mt-1 p-0" role="alert">
                                        <?php echo $ErrContraseña ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col col-12">
                            <div class="mb-3">
                                <label class="form-label" for="Contrasena1">Repetir contraseña</label>
                                <input required class="form-control password2" type="password" id="Contrasena1" name="usuario[Password2]" maxlength="16" onkeyup="validatePass1()" placeholder="Reescriba aquí la contraseña" value="<?php echo s($usuario->Password2); ?>">
                                <div class="error-message form-text" id="errorPass1"></div>
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
                    <button class="btn btn-info mt-1 mb-1" type="submit"> <b>Registrarse</b></button>
                </div>
            </div>
        </form>
    </div>
</div>


<script src="/build/sweetalert2@11.1.4/sweetalert2.js"></script>
<script src="/build/assets/js/stl_AllCreateUser.js"></script>
<script src="/build/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
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
<script>
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById('Contrasena');
        var password1Input = document.getElementById('Contrasena1');
        var passwordIcon = document.querySelector('.password-icon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            password1Input.type = 'text';
            passwordIcon.classList.remove('fa-eye');
            passwordIcon.classList.add('fa-eye-slash', 'password-visible');
        } else {
            passwordInput.type = 'password';
            password1Input.type = 'password';
            passwordIcon.classList.remove('fa-eye-slash', 'password-visible');
            passwordIcon.classList.add('fa-eye');
        }
    }

    function validatePass() {
        var password = document.getElementById('Contrasena').value;
        var errorPass = document.getElementById('errorPass');
        var inputPass = document.getElementById('Contrasena');
        var uno = document.getElementById('uno');
        var dos = document.getElementById('dos');
        var tres = document.getElementById('tres');
        var cuatro = document.getElementById('cuatro');
        var cinco = document.getElementById('cinco');
        var asteriscoUno = document.querySelector('#uno b');
        var asteriscoDos = document.querySelector('#dos b');
        var asteriscoTres = document.querySelector('#tres b');
        var asteriscoCuatro = document.querySelector('#cuatro b');
        var asteriscoCinco = document.querySelector('#cinco b');

        var regex = /^(?=.*[A-Z])(?=.*[a-z].*[a-z].*[a-z])(?=.*\d.*\d.*\d.*\d)(?=.*[*#@])[A-Za-z\d*#@]{8,16}$/;

        if (password === '') {
            errorPass.textContent = "La contraseña es obligatoria";
            errorPass.style.color = '#DC3545';
            inputPass.classList.add('is-invalid');
        } else if (!regex.test(password)) {
            errorPass.textContent = "La contraseña no cumple con los requisitos";
            errorPass.style.color = '#DC3545';
            inputPass.classList.add('is-invalid');
        } else {
            errorPass.textContent = '';
            inputPass.classList.remove('is-invalid');
        }

        if (password.length >= 8 && password.length <= 16) {
            uno.style.color = '#198754';
            asteriscoUno.style.color = '#198754';
        } else {
            uno.style.color = '';
            asteriscoUno.style.color = '';
        }

        if (/[A-Z]/.test(password)) {
            dos.style.color = '#198754';
            asteriscoDos.style.color = '#198754';
        } else {
            dos.style.color = '';
            asteriscoDos.style.color = '';
        }

        if (/[a-z].*[a-z].*[a-z]/.test(password)) {
            tres.style.color = '#198754';
            asteriscoTres.style.color = '#198754';
        } else {
            tres.style.color = '';
            asteriscoTres.style.color = '';
        }

        if (/[*#@]/.test(password)) {
            cuatro.style.color = '#198754';
            asteriscoCuatro.style.color = '#198754';
        } else {
            cuatro.style.color = '';
            asteriscoCuatro.style.color = '';
        }

        if (/\d.*\d.*\d/.test(password)) {
            cinco.style.color = '#198754';
            asteriscoCinco.style.color = '#198754';
        } else {
            cinco.style.color = '';
            asteriscoCinco.style.color = '';
        }
    }

    function validatePass1() {
        var password = document.getElementById('Contrasena1').value;
        var errorPass = document.getElementById('errorPass1');
        var inputPass = document.getElementById('Contrasena1');

        var regex = /^(?=.*[A-Z])(?=.*[a-z].*[a-z].*[a-z])(?=.*\d.*\d.*\d.*\d)(?=.*[*#@])[A-Za-z\d*#@]{8,16}$/;

        if (password === '') {
            errorPass.textContent = "La contraseña es obligatoria";
            errorPass.style.color = '#DC3545';
            inputPass.classList.add('is-invalid');
        } else if (!regex.test(password)) {
            errorPass.textContent = "La contraseña debe coincidir con la anterior";
            errorPass.style.color = '#DC3545';
            inputPass.classList.add('is-invalid');
        } else {
            errorPass.textContent = '';
            inputPass.classList.remove('is-invalid');
        }
    }
</script>