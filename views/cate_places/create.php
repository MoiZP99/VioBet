<?php
session_start();
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
  <link rel="stylesheet" href="/public/build/bootstrap/css/bootstrap.min.css">
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
  </style>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Categoría: Lugares Turísticos</h1>
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
                  <h2 class="card-title" style="font-size: 23px;"><strong>Crear:</strong> Categoría</h2>
                </div>
                <div class="card-body">
                  <form method="POST" action="create" id="regiration_form">
                    <fieldset>
                      <div class="row">
                        <div class="col col-12">
                          <div class="mb-3">
                            <label class="form-label" for="categoria">Categoría</label>
                            <input class="form-control" type="text" id="categoria" name="categoria_lugar[categoria_turismo]" autofocus placeholder="Escriba una categoría aquí" required onKeyUp="javascript:validateText('categoria')" value="<?php echo s($categoria->categoria_turismo); ?>">
                            <?php if ($errores) : ?>
                              <!-- SweetAlert -->
                              <script>
                                // Mostrar SweetAlert en caso de errores
                                Swal.fire({
                                  icon: 'error',
                                  title: '¡Errores!',
                                  text: 'Se encontraron errores en el formulario.',
                                  showConfirmButton: false,
                                  timer: 5000
                                });
                              </script>
                            <?php endif; ?>
                            <?php if ($errores) : ?>
                              <div class="alert alert-danger mt-1 p-0" role="alert">
                                <?php echo $errores ?>
                              </div>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                      <hr style="background-color: green;">
                      <div class="btn-spinner">
                        <a class="mt-2 btn btn-outline-danger col-auto col-xl-auto col-lg-auto col-md-auto col-sm-auto" href="/cate_places/index"> <i class="fas fa-times-circle"></i> <b>Cerrar</b> </a>
                        <button class="btn btn-outline-dark col-auto col-xl-auto col-lg-auto col-md-auto col-sm-auto mt-2" type="button" id="guardar" onclick="enviarFormulario()"> <b>Guardar</b> <i class="fas fa-save"></i> </button>
                      </div>
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

  <script src="/public/build/sweetalert2@11.1.4/sweetalert2.js"></script>
  <script src="/public/build/assets/js/stl_AllCreatePlace.js"></script>
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

  <script>
    // Almacenar referencias a los elementos del DOM - para mejorar el rendimiento
    var boton = document.getElementById("guardar");
    var formulario = document.getElementById("regiration_form");

    function enviarFormulario() {
      var spinner = document.createElement("span");
      spinner.className = "spinner-border spinner-border-sm";
      spinner.setAttribute("role", "status");
      spinner.setAttribute("aria-hidden", "true");

      boton.innerHTML = "";
      boton.disabled = true;
      boton.classList.add("verificando");
      boton.appendChild(spinner);
      boton.innerHTML += " Verificando...";

      setTimeout(function() {
        formulario.submit();
        boton.disabled = true;
        boton.classList.remove("verificando");
        boton.removeChild(spinner);
      }, 1000);

      return false; // Evita el envío automático del form y permite que el envío lo realice la función
    }
  </script>
</body>

</html>