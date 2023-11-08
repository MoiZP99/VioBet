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
              <h1>Detalles de la Ficha Medica</h1>
            </div>
          </div>
        </div>
      </section>

      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card" style="border-radius: 7px; background: #F8F8FF;">
              <form id="regiration_form">
                  <div class="card-header" style="background-color: #D6EAF8;">
                    <h2 class="card-title" style="font-size: 23px;"><strong>Detalles:</strong> Datos de la Ficha Medica</h2>
                  </div>
                  <div class="card-body">
                    <fieldset>
                      <div class="row">
                      <div class="col col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-12">
                          <div class="mb-3">
                            <label class="form-label" for="animal">Nombre del Animal</label>
                            <select disabled class="form-control" name="fichamedica[FKAnimal]" id="animal">
                              <option disabled>Seleccione aquí</option>
                              <?php foreach ($animal as $animal) : ?>
                                <option <?php echo $fichamedica->FKAnimal === $animal->IdAnimal ? 'selected' : ''; ?> value="<?php echo s($animal->IdAnimal); ?>"> <?php echo s($animal->Nombre); ?> </option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                        </div>
                        <div class="col col-xxl-6 col-xl-6 col-lg-6 col-sm-6 col-md-6 col-12">
                          <div class="mb-3">
                            <label class="form-label" for="tipo">Tipo de medicamento</label>
                            <select disabled class="form-control" autofocus name="fichamedica[TipoMedicamento]" id="tipomedicamento">
                              <option disabled>Seleccione aquí</option>
                              <option value="Vacuna" <?php echo ($fichamedica->TipoMedicamento === 'Vacuna') ? 'selected' : ''; ?>>Vacuna</option>
                              <option value="Antibiótico" <?php echo ($fichamedica->TipoMedicamento === 'Antibiótico') ? 'selected' : ''; ?>>Antibiótico</option>
                              <option value="Antiparasitario" <?php echo ($fichamedica->TipoMedicamento === 'Antiparasitario') ? 'selected' : ''; ?>>Antiparasitario</option>
                            </select>
                          </div>
                        </div>
                        <div class="col col-xxl-6 col-xl-6 col-lg-6 col-sm-6 col-md-6 col-12">
                          <div class="mb-3">
                            <label class="form-label" for="raza">Tipo de Sangre</label>
                            <input disabled class="form-control" type="text" id="tiposangre" name="fichamedica[TipoSangre]" onKeyUp="javascript:validateTextUbi('raza')" placeholder="Escriba aquí la raza" value="<?php echo s($fichamedica->TipoSangre); ?>">
                          </div>
                        </div>
                        <div class="col col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-12">
                          <div class="mb-3">
                            <label class="form-label" for="nombre">Antecedentes del Animal</label>
                            <input disabled class="form-control" type="text" id="antecedentes" name="fichamedica[Antecedentes]" onKeyUp="javascript:validateText('nombre')" placeholder="Esriba aquí el nombre" value="<?php echo s($fichamedica->Antecedentes); ?>">
                          </div>
                        </div>
                        <div class="col col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-12">
                          <div class="mb-3">
                            <label class="form-label" for="edad">Sintomas del Animal</label>
                            <input disabled class="form-control" type="text" id="sintomas" name="fichamedica[Sintomas]" onKeyUp="javascript:validateTextUbi('edad')" placeholder="Escriba aquí la edad" value="<?php echo s($fichamedica->Sintomas); ?>">
                          </div>
                        </div>
                        <div class="col col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-12">
                          <div class="mb-3">
                            <label class="form-label" for="peso">Diagnostico del Animal</label>
                            <input disabled class="form-control" type="text" id="diagnostico" name="fichamedica[Diagnostico]" onKeyUp="javascript:validateTextUbi('peso')" placeholder="Escriba aquí el peso" value="<?php echo s($fichamedica->Diagnostico); ?>">
                          </div>
                        </div>
                        <div class="col col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-12">
                          <div class="mb-3">
                            <label class="form-label" for="numero">Destalles del Medicamento</label>
                            <input disabled class="form-control" type="text" id="detallemedicamento" name="fichamedica[DetalleMedicamento]" onKeyUp="javascript:validateTextUbi('numero')" placeholder="Escriba aquí el número" value="<?php echo s($fichamedica->DetalleMedicamento); ?>">
                          </div>
                        </div>
                        <div class="col col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-12">
                          <div class="mb-3">
                            <label class="form-label" for="peso">Fecha de Revision</label>
                            <input disabled class="form-control" type="date" id="fecharevision" name="fichamedica[FechaRevision]" onKeyUp="javascript:validateTextUbi('peso')" placeholder="Escriba aquí el peso" value="<?php echo s($fichamedica->FechaRevision); ?>">
                          </div>
                        </div>
                      </div>
                    </fieldset>
                  </div>
                  <div class="card-footer">
                    <div class="row">
                      <div class="btn-spinner">
                        <a href="/fichamedica/index" class="btn btn-outline-danger col-auto me-2 col-xl-2 col-lg-2 col-md-2 col-sm-2 mt-1 mb-1"> <i class="fas fa-times-circle"></i> <b>Cerrar</b> </a>
                        <a class="btn btn-outline-dark col-auto me-2 col-xl-2 col-lg-2 col-md-2 col-sm-2 mt-1 mb-1" onclick="eliminarFichaMedica(<?php echo $fichamedica->IdFichaMedica ?>)"> <i class="fa-solid fa-trash-can"></i> <b> Eliminar</b></a>
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
  <script src="/public/build/assets/js/stl_AllDelete.js"></script>
    <script src="/public/build/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/public/build/jquery/jquery-3.3.1.min.js"></script>
    <script src="/public/build/sweetalert2@11.1.4/sweetalert2.js"></script>
</body>

</html>