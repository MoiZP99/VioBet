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
              <h1>Lugares Turísticos</h1>
            </div>
          </div>
        </div>
      </section>

      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-success" style="border-radius: 7px; background: #F8F8FF;">
                <div class="card-header" style="background: #13701C;">
                  <h2 class="card-title" style="font-size: 23px;"><strong>Crear:</strong> Lugar Turístico</h2>
                </div>
                <div class="card-body">
                  <form method="POST" action="create" id="regiration_form" enctype="multipart/form-data">
                    <fieldset id="paso1">
                      <legend class="mb-3" style="margin-top:-17px; margin-left:-4px;"><strong class="row" style="background:#4B3621; color:#fff;  padding-left:16px; margin-right:-20px;">Datos del lugar</strong></legend>
                      <?php if ($errores) : ?>
                        <!-- SweetAlert -->
                        <script>
                          // Mostrar SweetAlert en caso de errores
                          Swal.fire({
                            icon: 'error',
                            title: 'Se encontraron errores en el formulario!',
                            text: 'Revise el formulario en búsqueda del error.',
                            showConfirmButton: false,
                            timer: 5000
                          });
                        </script>
                      <?php endif; ?>
                      <?php if ($errores) : ?>
                        <div class="alert alert-warning d-flex align-items-center justify-content-center p-1" role="alert">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                          </svg>
                          <div>
                            <?php echo $errores; ?>
                          </div>
                        </div>
                      <?php endif; ?>
                      <div class="row">
                        <div class="col col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-12">
                          <div class="mb-3">
                            <label class="form-label" for="nombre">Nombre</label>
                            <input required class="form-control" type="text" id="nombre" autofocus name="lugar[Nombre_Lugar]" onKeyUp="javascript:validateText('nombre')" placeholder="Esriba el nombre aquí" value="<?php echo s($lugar->Nombre_Lugar); ?>">
                            <?php if ($ErrNombPer) : ?>
                              <div class="alert alert-danger mt-1 p-0" role="alert">
                                <?php echo $ErrNombPer ?>
                              </div>
                            <?php endif; ?>
                          </div>
                        </div>
                        <div class="col col-xxl-6 col-xl-6 col-lg-6 col-sm-6 col-md-6 col-12">
                          <div class="mb-3">
                            <label class="form-label" for="tipo_espacio">Tipo de lugar</label>
                            <select required class="form-select" name="lugar[TipoEspacio_Id]" id="tipo_espacio">
                              <option disabled selected>Seleccione aquí</option>
                              <?php foreach ($resultadoespacio as $espacio) : ?>
                                <option <?php echo $lugar->TipoEspacio_Id === $espacio->Id ? 'selected' : ''; ?> value="<?php echo s($espacio->Id); ?>"> <?php echo s($espacio->Espacio); ?> </option>
                              <?php endforeach; ?>
                            </select>
                            <?php if ($ErrLugar) : ?>
                              <div class="alert alert-danger mt-1 p-0" role="alert">
                                <?php echo $ErrLugar ?>
                              </div>
                            <?php endif; ?>
                          </div>
                        </div>
                        <div class="col col-xxl-12 col-xl-12 col-lg-12 col-sm-6 col-md-12 col-12">
                          <div class="mb-3">
                            <label class="form-label" for="ubicacion">Ubicación</label>
                            <input required class="form-control" type="text" id="ubicacion" name="lugar[Ubicacion]" onKeyUp="javascript:validateTextUbi('ubicacion')" placeholder="Escriba la dirección aquí" value="<?php echo s($lugar->Ubicacion); ?>">
                            <?php if ($ErrUbi) : ?>
                              <div class="alert alert-danger mt-1 p-0" role="alert">
                                <?php echo $ErrUbi ?>
                              </div>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col col-xxl-6 col-xl-6 col-lg-6 col-sm-6 col-md-6 col-12">
                          <div class="mb-3">
                            <label class="form-label" for="descripcion">Descripción</label>
                            <textarea required class="form-control" rows="1" maxlength="70" style="overflow: hidden; resize: none;" onkeypress="auto_grow(this);" onkeyUp="auto_grow(this); javascript:validateText('descripcion');" id="descripcion" placeholder="Escriba la descripción aquí" name="lugar[Descripcion]"><?php echo s($lugar->Descripcion); ?></textarea>
                            <span class="form-text">Mínimo <span id="minimo">50</span> caracteres.<span style="color: red;"><b>*</b></span> </span>                  
                            <span class="form-text"> <span id="contador">0 </span> caracteres de 70.<span style="color:blue;"><b>*</b></span> </span>
                            <?php if ($ErrDescrip) : ?>
                              <div class="alert alert-danger mt-1 p-0" role="alert">
                                <?php echo $ErrDescrip ?>
                              </div>
                            <?php endif; ?>
                          </div>
                        </div>
                        <div class="col col-xxl-6 col-xl-6 col-lg-6 col-sm-6 col-md-6 col-12">
                          <div class="mb-3">
                            <label class="form-label" for="categoria">Categoría</label>
                            <select required class="form-control" name="lugar[categoria_Id]" id="categoria">
                              <option selected disabled>Seleccione aquí</option>
                              <?php foreach ($resultadocategoria as $categoria_lugar) : ?>
                                <option <?php echo $lugar->categoria_Id === $categoria_lugar->Id ? 'selected' : ''; ?> value="<?php echo s($categoria_lugar->Id); ?>"><?php echo s($categoria_lugar->categoria_turismo); ?></option>
                              <?php endforeach; ?>
                            </select>
                            <?php if ($ErrCate) : ?>
                              <div class="alert alert-danger mt-1 p-0" role="alert">
                                <?php echo $ErrCate ?>
                              </div>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col col col-xxl-6 col-xl-6 col-lg-6 col-sm-6 col-md-6 col-12">
                          <div class="mb-4">
                            <label class="form-label" for="imagen">Imagen</label>
                            <input required class="form-control" type="file" id="imagen" accept="image/jpeg, image/jpg" name="lugar[Imagen]">
                            <?php if ($ErrImg) : ?>
                              <div class="alert alert-danger mt-1 p-0" role="alert">
                                <?php echo $ErrImg ?>
                              </div>
                            <?php endif; ?>
                            <div class="mt-1" id='previa'></div>
                          </div>
                        </div>
                        <div class="col col-xxl-6 col-xl-6 col-lg-6 col-sm-6 col-md-6 col-12">
                          <div class="mb-3">
                            <label class="form-label" for="estado">Estado</label>
                            <select required class="form-select" name="lugar[FK_Estado]" id="estado">
                              <option disabled selected>Seleccione aquí</option>
                              <?php foreach ($resultadoestado as $estado) : ?>
                                <option <?php echo $lugar->FK_Estado === $estado->Id ? 'selected' : ''; ?> value="<?php echo s($estado->Id); ?>"> <?php echo s($estado->Estado); ?> </option>
                              <?php endforeach; ?>
                            </select>
                            <?php if ($ErrEstado) : ?>
                              <div class="alert alert-danger mt-1 p-0" role="alert">
                                <?php echo $ErrEstado ?>
                              </div>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                      <hr style="background-color: green;">
                      <a class="mt-2 btn btn-outline-danger col-auto col-xl-auto col-lg-auto col-md-auto col-sm-auto" href="/places/index"> <i class="fas fa-times-circle"></i> <b>Cerrar</b> </a>
                      <button type="button" class="btnPass mt-2 btn btn-outline-success next col-auto col-xl-auto col-lg-auto col-md-auto col-sm-auto" onclick="validarPaso('paso1', 'paso2')"><b>Paso 2 <i class="fas fa-hand-point-right"></i> </b></button>
                    </fieldset>

                    <fieldset id="paso2">
                      <legend class="mb-3" style="margin-top:-17px; margin-left:-4px;"><strong class="row" style="background:#4B3621; color:#fff;  padding-left:16px; margin-right:-20px;">Horario de atención</strong></legend>
                      <?php if ($errores) : ?>
                        <div class="alert alert-warning d-flex align-items-center justify-content-center p-1" role="alert">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                          </svg>
                          <div>
                            <?php echo $errores ?>
                          </div>
                        </div>
                      <?php endif; ?>
                      <div class="row">
                        <div class="col col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                          <div class="mb-3">
                            <label class="form-label" for="horaA">Hora de apertura</label>
                            <input required class="form-control" id="horaA" type="time" name="lugar[Hora_apertura]" value="<?php echo s($lugar->Hora_apertura); ?>">
                            <span class="form-text">
                              Formato de 24 horas.
                            </span>
                            <?php if ($ErrHoraI) : ?>
                              <div class="alert alert-danger mt-1 p-0" role="alert">
                                <?php echo $ErrHoraI ?>
                              </div>
                            <?php endif; ?>
                          </div>
                        </div>
                        <div class="col col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                          <div class="mb-3">
                            <label class="form-label" for="horaC">Hora de cierre</label>
                            <input required class="form-control" id="horaC" type="time" name="lugar[Hora_clausura]" value="<?php echo s($lugar->Hora_clausura); ?>">
                            <span class="form-text">
                              Formato de 24 horas.
                            </span>
                            <?php if ($ErrHoraF) : ?>
                              <div class="alert alert-danger mt-1 p-0" role="alert">
                                <?php echo $ErrHoraF ?>
                              </div>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                          <div class="mb-3">
                            <label class="form-label" for="diaA">Día de apertura</label>
                            <select required class="form-select" name="lugar[DiaApertura_Id]" id="diaA">
                              <option selected disabled>Seleccione aquí</option>
                              <?php foreach ($resultadodiasl as $dias) : ?>
                                <option <?php echo $lugar->DiaApertura_Id === $dias->Id ? 'selected' : ''; ?> value="<?php echo s($dias->Id); ?>"> <?php echo s($dias->Nombre_Dial); ?> </option>
                              <?php endforeach; ?>
                            </select>
                            <?php if ($ErrDiaI) : ?>
                              <div class="alert alert-danger mt-1 p-0" role="alert">
                                <?php echo $ErrDiaI ?>
                              </div>
                            <?php endif; ?>
                          </div>
                        </div>
                        <div class="col col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                          <div class="mb-3">
                            <label class="form-label" for="diaC">Día de cierre</label>
                            <select required class="form-select" name="lugar[DiaClausura_Id]" id="diaC">
                              <option selected disabled>Seleccione aquí</option>
                              <?php foreach ($resultadodiasll as $dias2) : ?>
                                <option <?php echo $lugar->DiaClausura_Id === $dias2->Id ? 'selected' : ''; ?> value="<?php echo s($dias2->Id); ?>"> <?php echo s($dias2->Nombre_Diall); ?> </option>
                              <?php endforeach; ?>
                            </select>
                            <?php if ($ErrDiaF) : ?>
                              <div class="alert alert-danger mt-1 p-0" role="alert">
                                <?php echo $ErrDiaF ?>
                              </div>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                      <hr style="background-color: green;">
                      <button type="button" class="previous btn btn-outline-primary mt-2" onclick="validarPaso('paso2', 'paso1')"> <i class="fas fa-hand-point-left"></i> <b>Paso 1</b> </button>
                      <button type="button" class="btnPass btn btn-outline-success next mt-2" onclick="validarPaso('paso2', 'paso3')"><b>Paso 3 <i class="fas fa-hand-point-right"></i> </b></button>
                    </fieldset>

                    <fieldset id="paso3">
                      <legend class="mb-3" style="margin-top:-17px; margin-left:-4px;"><strong class="row" style="background:#4B3621; color:#fff;  padding-left:16px; margin-right:-20px;">Datos de contacto</strong></legend>
                      <?php if ($errores) : ?>
                        <div class="alert alert-warning d-flex align-items-center justify-content-center p-1" role="alert">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                          </svg>
                          <div>
                            <?php echo $errores ?>
                          </div>
                        </div>
                      <?php endif; ?>
                      <div class="row">
                        <div class="col col-xxl-6 col-xl-6 col-lg-6 col-sm-6 col-md-6 col-12">
                          <div class="mb-3">
                            <label class="form-label" for="id_tel">Número de teléfono</label>
                            <input required class="form-control" type="tel" id="id_tel" name="lugar[Numero_Contacto]" onKeyUp="javascript:validateTel('id_tel')" placeholder="Escriba el número aquí" maxlength="8" required value="<?php echo s($lugar->Numero_Contacto); ?>">
                            <?php if ($ErrContacto) : ?>
                              <div class="alert alert-danger mt-1 p-0" role="alert">
                                <?php echo $ErrContacto ?>
                              </div>
                            <?php endif; ?>
                          </div>
                        </div>
                        <div class="col col-xxl-6 col-xl-6 col-lg-6 col-sm-6 col-md-6 col-12">
                          <div class="mb-3">
                            <label class="form-label" for="idMail">Correo electrónico</label>
                            <input required class="form-control" type="email" id="idMail" name="lugar[Correo]" onKeyUp="javascript:validateMail('idMail')" placeholder="Escriba el correo aquí" required value="<?php echo s($lugar->Correo); ?>">
                            <?php if ($ErrCorreo) : ?>
                              <div class="alert alert-danger mt-1 p-0" role="alert">
                                <?php echo $ErrCorreo ?>
                              </div>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                      <hr style="background-color: green;">
                      <div class="btn-spinner">
                        <button type="button" class="btn btn-outline-primary mt-2" onclick="validarPaso('paso3', 'paso2')"> <i class="fas fa-hand-point-left"></i> <b>Paso 2</b> </button>
                        <button class="btn btn-outline-dark col-auto col-xl-auto col-lg-auto col-md-auto col-sm-auto mt-2" type="button" id="submit_data" onclick="enviarFormulario()"> <b>Guardar</b> <i class="fas fa-save"></i> </button>
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