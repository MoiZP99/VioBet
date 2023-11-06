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
              <h1>Regristro de Ficha Medica de Animales</h1>
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
                    <h2 class="card-title" style="font-size: 23px;"><strong>Ingresar:</strong> Actualizar Ficha Medica</h2>
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
                      <div class="col col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-12">
                          <div class="mb-3">
                            <label class="form-label" for="animal">Nombre del Animal</label>
                            <select required class="form-select" autofocus name="fichamedica[FKAnimal]" id="animal">
                              <option disabled>Seleccione aquí</option>
                              <?php foreach ($animal as $animal) : ?>
                                <option <?php echo $fichamedica->FKAnimal === $animal->IdAnimal ? 'selected' : ''; ?> value="<?php echo s($animal->IdAnimal); ?>"> <?php echo s($animal->Nombre); ?> </option>
                              <?php endforeach; ?>
                            </select>
                            <?php if ($ErrFKAnimal) : ?>
                              <div class="alert alert-danger mt-1 p-0" role="alert">
                                <?php echo $ErrFKAnimal ?>
                              </div>
                            <?php endif; ?>
                          </div>
                        </div>
                        <div class="col col-xxl-6 col-xl-6 col-lg-6 col-sm-6 col-md-6 col-12">
                          <div class="mb-3">
                            <label class="form-label" for="TipoMedicamento">Tipo de medicamento</label>
                            <select required class="form-select" name="fichamedica[TipoMedicamento]" id="TipoMedicamento">
                              <option disabled>Seleccione aquí</option>
                              <option value="Vacuna" <?php echo ($fichamedica->TipoMedicamento === 'Vacuna') ? 'selected' : ''; ?>>Vacuna</option>
                              <option value="Antiparasitario" <?php echo ($fichamedica->TipoMedicamento === 'Antiparasitario') ? 'selected' : ''; ?>>Antiparasitario</option>
                              <option value="Antibiótico" <?php echo ($fichamedica->TipoMedicamento === 'Antibiótico') ? 'selected' : ''; ?>>Antibiótico</option>
                            </select>
                            <?php if ($ErrVac) : ?>
                              <div class="alert alert-danger mt-1 p-0" role="alert">
                                <?php echo $ErrVac ?>
                              </div>
                            <?php endif; ?>
                          </div>
                        </div>
                        <div class="col col-xxl-6 col-xl-6 col-lg-6 col-sm-6 col-md-6 col-12">
                          <div class="mb-3">
                            <label class="form-label" for="tiposangre">Tipo de Sangre</label>
                            <input required class="form-control" type="text" id="tiposangre" name="fichamedica[TipoSangre]" onKeyUp="javascript:validateTextUbi('tiposangre')" placeholder="Escriba aquí el tipo de sangre" value="<?php echo s($fichamedica->TipoSangre); ?>">
                            <?php if ($ErrSangr) : ?>
                              <div class="alert alert-danger mt-1 p-0" role="alert">
                                <?php echo $ErrSangr ?>
                              </div>
                            <?php endif; ?>
                          </div>
                        </div>
                        <div class="col col-xxl-6 col-xl-6 col-lg-6 col-sm-6 col-md-6 col-12">
                          <div class="mb-3">
                            <label class="form-label" for="antecedentes">Antecedentes del Animal</label>
                            <input required class="form-control" type="text" id="antecedentes" name="fichamedica[Antecedentes]" onKeyUp="javascript:validateTextUbi('antecedentes')" placeholder="Escriba aquí los antecedentes" value="<?php echo s($fichamedica->Antecedentes); ?>">
                            <?php if ($ErrAnte) : ?>
                              <div class="alert alert-danger mt-1 p-0" role="alert">
                                <?php echo $ErrAnte ?>
                              </div>
                            <?php endif; ?>
                          </div>
                        </div>
                        <div class="col col-xxl-6 col-xl-6 col-lg-6 col-sm-6 col-md-6 col-12">
                          <div class="mb-3">
                            <label class="form-label" for="sintomas">Sintomas del Animal</label>
                            <input required class="form-control" type="text" id="sintomas" name="fichamedica[Sintomas]" onKeyUp="javascript:validateTextUbi('sintomas')" placeholder="Escriba aquí los sintomas" value="<?php echo s($fichamedica->Sintomas); ?>">
                            <?php if ($ErrSinto) : ?>
                              <div class="alert alert-danger mt-1 p-0" role="alert">
                                <?php echo $ErrSinto ?>
                              </div>
                            <?php endif; ?>
                          </div>
                        </div>
                        <div class="col col-xxl-6 col-xl-6 col-lg-6 col-sm-6 col-md-6 col-12">
                          <div class="mb-3">
                            <label class="form-label" for="diagnostico">Diagnostico del Animal</label>
                            <input required class="form-control" type="text" id="diagnostico" name="fichamedica[Diagnostico]" onKeyUp="javascript:validateTextUbi('diagnostico')" placeholder="Escriba aquí el diagnostico" value="<?php echo s($fichamedica->Diagnostico); ?>">
                            <?php if ($ErrDiagno) : ?>
                              <div class="alert alert-danger mt-1 p-0" role="alert">
                                <?php echo $ErrDiagno ?>
                              </div>
                            <?php endif; ?>
                          </div>
                        </div>
                        <div class="col col-xxl-6 col-xl-6 col-lg-6 col-sm-6 col-md-6 col-12">
                          <div class="mb-3">
                            <label class="form-label" for="DetalleMedicamento">Detalles del medicamento</label>
                            <input required class="form-control" type="text" id="DetalleMedicamento" name="fichamedica[DetalleMedicamento]" onKeyUp="javascript:validateTextUbi('DetalleMedicamento')" placeholder="Escriba aquí el detaller" value="<?php echo s($fichamedica->DetalleMedicamento); ?>">
                            <?php if ($ErrMedi) : ?>
                              <div class="alert alert-danger mt-1 p-0" role="alert">
                                <?php echo $ErrMedi ?>
                              </div>
                            <?php endif; ?>
                          </div>
                        </div>
                        <div class="col col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                          <div class="mb-3">
                            <label class="form-label" for="fecharevision">Fecha de Revision</label>
                            <input required class="form-control" id="fecharevision" type="date" name="fichamedica[FechaRevision]" value="<?php echo s($fichamedica->FechaRevision); ?>" max="<?php echo date('Y-m-d'); ?>">
                            <?php if ($ErrFecha) : ?>
                              <div class="alert alert-danger mt-1 p-0" role="alert">
                                <?php echo $ErrFecha ?>
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
                        <a href="/fichamedica/index" class="btn btn-outline-danger col-auto me-2 col-xl-2 col-lg-2 col-md-2 col-sm-2 mt-1 mb-1" id="cerrarPagina"> <i class="fas fa-times-circle"></i> <b>Cerrar</b> </a>
                        <button class="btn btn-outline-dark col-auto col-xl-2 col-lg-2 col-md-2 col-sm-2 mt-1 mb-1" type="button" id="submit_data" onclick="enviarFormulario()"> <b>Actualizar</b> <i class="fas fa-save"></i> </button>
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

</body>

</html>