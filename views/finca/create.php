<?php
session_start();
include_once 'public/build/Sidebar.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BioVet</title>
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
      <section class="content-header mb-3" style="background-color: #80D0C7;">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Regristro de una nueva finca</h1>
            </div>
          </div>
        </div>
      </section>

      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card" style="border-radius: 7px; background: #F8F8FF;">
                <form method="POST" action="create" id="regiration_form">
                  <div class="card-header" style="background-color: #D6EAF8;">
                    <h2 class="card-title" style="font-size: 23px;"><strong>Ingresar:</strong> Nueva finca</h2>
                  </div>
                  <div class="card-body">
                    <fieldset>
                      <?php if ($errores) : ?>
                        <script>
                          Swal.fire({
                            icon: 'error',
                            title: '¡Se encontraron errores en el formulario!',
                            text: 'Debe corregir el error señalado.',
                            showConfirmButton: false,
                            timer: 5000
                          });
                        </script>
                      <?php endif; ?>
                      <div class="col col-12">
                        <div class="mb-3">
                          <label class="form-label" for="raza">Nombre de la finca</label>
                          <input required class="form-control" type="text" id="nombre" name="finca[NombreFinca]" autofocus onKeyUp="javascript:validateTextUbi('nombre')" placeholder="Escriba aquí el nombre de la finca" value="<?php echo s($finca->NombreFinca); ?>">
                          <?php if ($ErrNomb) : ?>
                            <div class="alert alert-danger mt-1 p-0" role="alert">
                              <?php echo $ErrNomb ?>
                            </div>
                          <?php endif; ?>
                        </div>
                      </div>
                      <div class="col col-12">
                        <div class="mb-3">
                          <label class="form-label" for="raza">Ubicación de la finca</label>
                          <input required class="form-control" type="text" id="ubicacion" name="finca[Ubicacion]" onKeyUp="javascript:validateTextUbi('ubicacion')" placeholder="Escriba aquí la ubicación" value="<?php echo s($finca->Ubicacion); ?>">
                          <?php if ($ErrUbi) : ?>
                            <div class="alert alert-danger mt-1 p-0" role="alert">
                              <?php echo $ErrUbi ?>
                            </div>
                          <?php endif; ?>
                        </div>
                      </div>
                      <div class="col col-12">
                        <div class="mb-3">
                          <label class="form-label" for="raza">Tamaño de la finca</label>
                          <input required class="form-control" type="text" id="tamano" name="finca[Tamano]" onKeyUp="javascript:validateTextUbi('tamano')" placeholder="Escriba aquí el tamaño" value="<?php echo s($finca->Tamano); ?>">
                          <?php if ($ErrTama) : ?>
                            <div class="alert alert-danger mt-1 p-0" role="alert">
                              <?php echo $ErrTama ?>
                            </div>
                          <?php endif; ?>
                        </div>
                      </div>
                      <div class="col col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-12">
                          <div class="mb-3">
                            <label class="form-label" for="usuario">Usuario</label>
                            <select required class="form-control" name="finca[FKUsuario]" id="usuario">
                              <?php foreach ($usuario as $usuario) : ?>
                                <option <?php echo $finca->FKUsuario === $usuario->IdUsuario ? 'selected' : ''; ?> value="<?php echo s($usuario->IdUsuario); ?>"> <?php echo s($usuario->NombreUser); ?> </option>
                              <?php endforeach; ?>
                            </select>
                            <?php if ($ErrFKFinca) : ?>
                              <div class="alert alert-danger mt-1 p-0" role="alert">
                                <?php echo $ErrFKFinca ?>
                              </div>
                            <?php endif; ?>
                          </div>
                        </div>
                    </fieldset>
                  </div>
                  <div class="card-footer">
                    <div class="row">
                      <div class="btn-spinner">
                        <button type="button" class="btn btn-outline-danger col-auto me-2 col-xl-2 col-lg-2 col-md-2 col-sm-2 mt-1 mb-1" id="cerrarPagina"> <i class="fas fa-times-circle"></i> <b>Cerrar</b> </button>
                        <button class="btn btn-outline-dark col-auto col-xl-2 col-lg-2 col-md-2 col-sm-2 mt-1 mb-1" type="button" id="submit_data" onclick="enviarFormulario()"> <b>Guardar</b> <i class="fas fa-save"></i> </button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
    </div>
    </section>
  </div>
  </div>

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
    var boton = document.getElementById("submit_data");
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

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      var formulario = document.getElementById("regiration_form");
      var botonCerrar = document.getElementById("cerrarPagina");

      botonCerrar.addEventListener("click", function() {
        var nombre = formulario.elements["nombre"].value;
        var ubicacion = formulario.elements["ubicacion"].value;
        var tamano = formulario.elements["tamano"].value;

        if (nombre !== '' || ubicacion !== 'selected' || tamano !== 'selected') {
          Swal.fire({
            title: '¿Cancelar proceso?',
            text: '¿Desea cancelar el proceso?',
            icon: 'warning',
            showCancelButton: true,
            allowOutsideClick: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<i class="fas fa-check"></i> Cerrar',
            cancelButtonText: '<i class="fas fa-times"></i> Cancelar',
            buttonsStyling: false,
            customClass: {
              confirmButton: 'btn btn-outline-danger mx-2',
              cancelButton: 'btn btn-outline-secondary'
            }
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = '/finca/index';
            }
          });
        } else {
          window.location.href = '/finca/index';
        }
      });
    });
  </script>
</body>

</html>