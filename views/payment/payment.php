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
              <h1>Pagar membresia premium</h1>
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
                    <h2 class="card-title" style="font-size: 23px;"><strong>Subscribirse</strong></h2>
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
                            timer: 2000
                          });
                        </script>
                      <?php endif; ?>
                      <div class="row">
                        <div class="col col-xxl-6 col-xl-6 col-lg-6 col-sm-6 col-md-6 col-12">
                          <div class="mb-3">
                            <label class="form-label" for="tiposangre">Nombre del titular</label>
                            <input required class="form-control" type="text" id="tiposangre" name="animal[TipoSangre]" onKeyUp="javascript:validateTextUbi('tiposangre')" placeholder="Escriba aquí el nombre del titular" value="">
                          </div>
                        </div>
                        <div class="col col-xxl-6 col-xl-6 col-lg-6 col-sm-6 col-md-6 col-12">
                          <div class="mb-3">
                            <label class="form-label" for="raza">Número de tarjeta</label>
                            <input required class="form-control" type="text" id="raza" name="animal[Raza]" onKeyUp="javascript:validateTextUbi('raza')" placeholder="XXXX-XXXX-XXXX-XXXX" value="">
                          </div>
                        </div>

                        <div class="col col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-12">
                          <div class="mb-3">
                            <label class="form-label" for="nombre">Fecha de caducidad</label>
                            <input required class="form-control" type="date" id="nombre" name="animal[Nombre]" onKeyUp="javascript:validateText('nombre')" placeholder="" value="">
                          </div>
                        </div>
                        <div class="col col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-12">
                          <div class="mb-3">
                            <label class="form-label" for="edad">Código de seguridad</label>
                            <input required class="form-control" type="int" id="edad" name="animal[Edad]" onKeyUp="javascript:validateTextUbi('edad')" placeholder="CVC" value="">
                          </div>
                        </div>

                        <div class="col col-xxl-6 col-xl-6 col-lg-6 col-sm-6 col-md-6 col-12">
                          <div class="mb-3">
                            <label class="form-label" for="tipo">Provincia</label>
                            <select required class="form-select" autofocus name="animal[Tipo]" id="tipo">
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
                    </fieldset>
                  </div>
                  <div class="card-footer">
                    <div class="row">
                      <div class="btn-spinner">
                        <button type="button" class="btn btn-outline-danger col-auto me-2 col-xl-2 col-lg-2 col-md-2 col-sm-2 mt-1 mb-1" id="cerrarPagina"> <i class="fas fa-times-circle"></i> <b>Cerrar</b> </button>
                        <button class="btn btn-outline-dark col-auto col-xl-2 col-lg-2 col-md-2 col-sm-2 mt-1 mb-1" type="button" id="submit_data" onclick="enviarFormulario()"> <b>Pagar</b> <i class="fas fa-money-check"></i> </button>
                      </div>
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
        var tipo = formulario.elements["tipo"].value;
        var tiposangre = formulario.elements["tiposangre"].value;
        var raza = formulario.elements["raza"].value;
        var sexo = formulario.elements["sexo"].value;
        var edad = formulario.elements["edad"].value;
        var peso = formulario.elements["peso"].value;
        var numero = formulario.elements["numero"].value;
     
        var finca = formulario.elements["finca"].value;

        if (nombre !== '' || tipo !== 'selected' ||  tiposangre !== '' ||raza !== '' || sexo !== 'selected' || edad !== '' || peso !== '' || numero !== '' || finca !== 'selected') {
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
              window.location.href = '/animal/index';
            }
          });
        } else {
          window.location.href = '/animal/index';
        }
      });
    });
  </script>
</body>

</html>