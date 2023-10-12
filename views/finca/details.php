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
      <section class="content-header bg-gradient-gray mb-3">
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
              <div class="card card-success" style="border-radius: 7px; background: #F8F8FF;">
                <div class="card-header" style="background: #13701C;">
                </div>
                <div class="card-body">
                  <form method="POST" action="create" id="regiration_form">
                    <fieldset>
                      <div class="row">
                      <div class="col col-xxl-6 col-xl-6 col-lg-6 col-sm-6 col-md-6 col-12">
                          <div class="mb-3">
                            <label class="form-label" for="nombre">Nombre</label>
                            <input readonly class="form-control" type="text" id="nombre" value="<?php echo s($finca->Nombre); ?>">
                          </div>
                      </div>
                        <div class="col col-xxl-6 col-xl-6 col-lg-6 col-sm-6 col-md-6 col-12">
                          <div class="mb-3">
                            <label class="form-label" for="ubicacion">Ubicación de la finca</label>
                            <input readonly class="form-control" type="text" id="ubicacion" value="<?php echo s($finca->Ubicacion); ?>">
                          </div>
                        </div>
                        <div class="col col-xxl-6 col-xl-6 col-lg-6 col-sm-6 col-md-6 col-12">
                          <div class="mb-3">
                            <label class="form-label" for="tamano">Tamaño de la finca</label>
                            <input readonly class="form-control" type="text" id="tamano" value="<?php echo s($finca->Tamano); ?>">
                          </div>
                        </div>
                      </div>
                    </fieldset>
                  </form>
                </div>
                <div class="card-footer">
                  <div class="row">
                    <div class="btn-spinner">
                      <a class="btn btn-outline-danger col-auto me-2 col-xl-2 col-lg-2 col-md-2 col-sm-2 mt-1 mb-1" href="/finca/index"> <i class="fas fa-times-circle"></i> <b>Cerrar</b> </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>

</body>

</html>