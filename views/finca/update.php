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
  <link rel="stylesheet" href="//build/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="//build/assets/css/stl_AllCreate.css">
  <link rel="stylesheet" href="//build/sweetalert2@11.1.4/sweetalert2.css">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <div class="content-wrapper">
    <section class="content-header mb-3" style="background-color: #80D0C7;">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Actualización de datos la finca</h1>
            </div>
          </div>
        </div>
      </section>

      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card" style="border-radius: 7px; background: #F8F8FF;">
                <form method="POST" id="regiration_form">
                  <div class="card-header" style="background-color: #D6EAF8;">
                    <h2 class="card-title" style="font-size: 23px;"><strong>Actualizar:</strong> Datos de la finca</h2>
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
                          <?php if ($ErrNombre) : ?>
                            <div class="alert alert-danger mt-1 p-0" role="alert">
                              <?php echo $ErrNombre ?>
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
                              <option <?php echo $finca->IdFinca === $usuario->IdUsuario ? 'selected' : ''; ?> value="<?php echo s($usuario->IdUsuario); ?>"> <?php echo s($usuario->NombreUser); ?> </option>
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
                        <a href="/finca/index" class="btn btn-outline-danger col-auto me-2 col-xl-2 col-lg-2 col-md-2 col-sm-2 mt-1 mb-1"> <i class="fas fa-times-circle"></i> <b>Cerrar</b> </a>
                        <button class="btn btn-outline-dark col-auto col-xl-2 col-lg-2 col-md-2 col-sm-2 mt-1 mb-1" type="button" id="submit_data" onclick="enviarFormulario()"> <b>Guardar</b> <i class="fas fa-save"></i> </button>
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

  <script src="//build/assets/js/stl_Update.js"></script>
  <script src="//build/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="//build/jquery/jquery-3.3.1.min.js"></script>
  <script src="//build/sweetalert2@11.1.4/sweetalert2.js"></script>
  <script>
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
    // --------------------------------------------------------------------------
    function previewImage(event) {
      var input = event.target;
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          var previewElement = document.getElementById('imagen-preview');
          previewElement.src = e.target.result;
        };

        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
</body>

</html>