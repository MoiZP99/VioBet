<?php
include_once 'public/build/Sidebar.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BioVet</title>
  <link rel="stylesheet" href="/public/build/FontFamily_admin_section/fontfamily.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
  <link rel="stylesheet" href="/public/build/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="/public/build/assets/css/stl_AllCreate.css">
  <link rel="stylesheet" href="/public/build/sweetalert2@11.1.4/sweetalert2.css">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <div class="content-wrapper">
      <section class="content-header mb-3" style="background-color: #80D0C7;">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Lugares Turísticos</h1>
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
                    <h2 class="card-title" style="font-size: 23px;"><strong>Actualizar:</strong> datos del animal</h2>
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
                            <label class="form-label" for="tipo">Tipo de animal</label>
                            <select required class="form-select" autofocus name="animal[Tipo]" id="tipo">
                              <option disabled>Seleccione aquí</option>
                              <option value="Vaca" <?php echo ($animal->Tipo === 'Vaca') ? 'selected' : ''; ?>>Vaca</option>
                              <option value="Toro" <?php echo ($animal->Tipo === 'Toro') ? 'selected' : ''; ?>>Toro</option>
                              <option value="Caballo" <?php echo ($animal->Tipo === 'Caballo') ? 'selected' : ''; ?>>Caballo</option>
                              <option value="Yegua" <?php echo ($animal->Tipo === 'Yegua') ? 'selected' : ''; ?>>Yegua</option>
                            </select>
                            <?php if ($ErrTipo) : ?>
                              <div class="alert alert-danger mt-1 p-0" role="alert">
                                <?php echo $ErrTipo ?>
                              </div>
                            <?php endif; ?>
                          </div>
                        </div>

                        <div class="col col-xxl-6 col-xl-6 col-lg-6 col-sm-6 col-md-6 col-12">
                          <div class="mb-3">
                            <label class="form-label" for="tiposangre">Tipo de Sangre</label>
                            <input required class="form-control" type="text" id="tiposangre" name="animal[TipoSangre]" onKeyUp="javascript:validateTextUbi('tiposangre')" placeholder="Escriba aquí el tipo de sangre" value="<?php echo s($animal->TipoSangre); ?>">
                            <?php if ($ErrSangr) : ?>
                              <div class="alert alert-danger mt-1 p-0" role="alert">
                                <?php echo $ErrSangr ?>
                              </div>
                            <?php endif; ?>
                          </div>
                        </div>


                        <div class="col col-xxl-6 col-xl-6 col-lg-6 col-sm-6 col-md-6 col-12">
                          <div class="mb-3">
                            <label class="form-label" for="raza">Raza del animal</label>
                            <input required class="form-control" type="text" id="raza" name="animal[Raza]" onKeyUp="javascript:validateTextUbi('raza')" placeholder="Escriba aquí la raza" value="<?php echo s($animal->Raza); ?>">
                            <?php if ($ErrRaza) : ?>
                              <div class="alert alert-danger mt-1 p-0" role="alert">
                                <?php echo $ErrRaza ?>
                              </div>
                            <?php endif; ?>
                          </div>
                        </div>
                        <div class="col col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-12">
                          <div class="mb-3">
                            <label class="form-label" for="sexo">Sexo del animal</label>
                            <select required class="form-select" name="animal[Sexo]" id="sexo">
                              <option disabled>Seleccione aquí</option>
                              <option value="Macho" <?php echo ($animal->Sexo === 'Macho') ? 'selected' : ''; ?>>Macho</option>
                              <option value="Hembra" <?php echo ($animal->Sexo === 'Hembra') ? 'selected' : ''; ?>>Hembra</option>
                            </select>
                            <?php if ($ErrSexo) : ?>
                              <div class="alert alert-danger mt-1 p-0" role="alert">
                                <?php echo $ErrSexo ?>
                              </div>
                            <?php endif; ?>
                          </div>
                        </div>
                        <div class="col col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-12">
                          <div class="mb-3">
                            <label class="form-label" for="nombre">Nombre del animal</label>
                            <input required class="form-control" type="text" id="nombre" name="animal[Nombre]" onKeyUp="javascript:validateText('nombre')" placeholder="Esriba aquí el nombre" value="<?php echo s($animal->Nombre); ?>">
                            <?php if ($ErrNomb) : ?>
                              <div class="alert alert-danger mt-1 p-0" role="alert">
                                <?php echo $ErrNomb ?>
                              </div>
                            <?php endif; ?>
                          </div>
                        </div>
                        <div class="col col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-12">
                          <div class="mb-3">
                            <label class="form-label" for="edad">Edad del animal</label>
                            <input required class="form-control" type="int" id="edad" name="animal[Edad]" onKeyUp="javascript:validateTextUbi('edad')" placeholder="Escriba aquí la edad" value="<?php echo s($animal->Edad); ?>">
                            <?php if ($ErrEdad) : ?>
                              <div class="alert alert-danger mt-1 p-0" role="alert">
                                <?php echo $ErrEdad ?>
                              </div>
                            <?php endif; ?>
                          </div>
                        </div>
                        <div class="col col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-12">
                          <div class="mb-3">
                            <label class="form-label" for="peso">Peso del animal (Kg)</label>
                            <input required class="form-control" type="int" id="peso" name="animal[Peso]" onKeyUp="javascript:validateTextUbi('peso')" placeholder="Escriba aquí el peso" value="<?php echo s($animal->Peso); ?>">
                            <?php if ($ErrPeso) : ?>
                              <div class="alert alert-danger mt-1 p-0" role="alert">
                                <?php echo $ErrPeso ?>
                              </div>
                            <?php endif; ?>
                          </div>
                        </div>
                        <div class="col col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-12">
                          <div class="mb-3">
                            <label class="form-label" for="numero">Número en arete del animal</label>
                            <input required class="form-control" type="int" id="numero" name="animal[Numero]" onKeyUp="javascript:validateTextUbi('numero')" placeholder="Escriba aquí el número" value="<?php echo s($animal->Numero); ?>">
                            <?php if ($ErrNum) : ?>
                              <div class="alert alert-danger mt-1 p-0" role="alert">
                                <?php echo $ErrNum ?>
                              </div>
                            <?php endif; ?>
                          </div>
                        </div>

                    



                        <div class="col col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-12">
                          <div class="mb-3">
                            <label class="form-label" for="finca">Finca</label>
                            <select required class="form-select" name="animal[FKFinca]" id="finca">
                              <option disabled>Seleccione aquí</option>
                              <?php foreach ($finca as $finca) : ?>
                                <option <?php echo $animal->FKFinca === $finca->IdFinca ? 'selected' : ''; ?> value="<?php echo s($finca->IdFinca); ?>"> <?php echo s($finca->NombreFinca); ?> </option>
                              <?php endforeach; ?>
                            </select>
                            <?php if ($ErrFKFinca) : ?>
                              <div class="alert alert-danger mt-1 p-0" role="alert">
                                <?php echo $ErrFKFinca ?>
                              </div>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                    </fieldset>
                  </div>
                  <div class="card-footer">
                    <div class="row">
                      <div class="btn-spinner">
                        <a href="/animal/index" class="btn btn-outline-danger col-auto me-2 col-xl-2 col-lg-2 col-md-2 col-sm-2 mt-1 mb-1"> <i class="fas fa-times-circle"></i> <b>Cerrar</b> </a>
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

  <script src="/public/build/assets/js/stl_Update.js"></script>
  <script src="/public/build/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/public/build/jquery/jquery-3.3.1.min.js"></script>
  <script src="/public/build/sweetalert2@11.1.4/sweetalert2.js"></script>
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