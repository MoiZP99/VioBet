<?php
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
                  <h2 class="card-title" style="font-size: 23px;">Actualizar: Categoría</h2>
                </div>
                <div class="card-body">
                  <form method="POST" id="regiration_form">
                    <fieldset>
                      <div class="row">
                        <div class="col col-12">
                          <div class="mb-3">
                            <label class="form-label" for="categoria">Categoría</label>
                            <input class="form-control" autofocus type="text" id="categoria" name="categoria_lugar[categoria_turismo]" placeholder="Escriba una categoría aquí" onKeyUp="javascript:validateText('categoria')" value="<?php echo s($categoria->categoria_turismo); ?>">
                            <?php if ($errores) : ?>
                              <div class="alert alert-danger mt-1 p-0" role="alert">
                                <?php echo $errores ?>
                              </div>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                      <hr style="background-color: green;">
                      <a class="mt-2 btn btn-outline-danger col-auto col-xl-auto col-lg-auto col-md-auto col-sm-auto" href="/cate_places/index"> <i class="fas fa-times-circle"></i> <b>Cerrar</b> </a>
                      <button type="submit" class="btn btn-outline-dark submit col-auto col-xl-auto col-lg-auto col-md-auto col-sm-auto mt-2" id="alert"> <b>Guardar</b> <i class="fas fa-save"></i> </button>
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

  <script src="/public/build/assets/js/stl_AllCreatePlace.js"></script>
  <script src="/public/build/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/public/build/jquery/jquery-3.3.1.min.js"></script>
  <script src="/public/build/sweetalert2@11.1.4/sweetalert2.js"></script>
  <script>
    const btnGuardar = document.getElementById('alert');

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
            document.getElementById('regiration_form').submit();
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
  </script>
</body>

</html>