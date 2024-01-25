<?php
session_start();
include_once '/build/Sidebar.php';
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
              <h1>Detalles de la finca</h1>
            </div>
          </div>
        </div>
      </section>

      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card" style="border-radius: 7px; background: #F8F8FF;">
              <form>
                  <div class="card-header" style="background-color: #D6EAF8;">
                    <h2 class="card-title" style="font-size: 23px;"><strong>Detalles:</strong> Datos de la finca</h2>
                  </div>
                  <div class="card-body">
                    <fieldset>
                      <div class="col col-12">
                        <div class="mb-3">
                          <label class="form-label" for="raza">Nombre de la finca</label>
                          <input disabled class="form-control" type="text" id="nombre" name="finca[NombreFinca]" autofocus onKeyUp="javascript:validateTextUbi('nombre')" placeholder="Escriba aquí el nombre de la finca" value="<?php echo s($finca->NombreFinca); ?>">
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
                          <input disabled class="form-control" type="text" id="ubicacion" name="finca[Ubicacion]" onKeyUp="javascript:validateTextUbi('ubicacion')" placeholder="Escriba aquí la ubicación" value="<?php echo s($finca->Ubicacion); ?>">
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
                          <input disabled class="form-control" type="text" id="tamano" name="finca[Tamano]" onKeyUp="javascript:validateTextUbi('tamano')" placeholder="Escriba aquí el tamaño" value="<?php echo s($finca->Tamano); ?>">
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
                          <select disabled class="form-control" name="finca[FKUsuario]" id="usuario">
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

</body>

</html>