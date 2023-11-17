<?php
include_once 'public/build/Sidebar.php';
?>
<!DOCTYPE html>
<html lang="en">

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <div class="content-wrapper">
      <section class="content-header bg-gradient-gray mb-3">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Módulo de Usuarios</h1>
            </div>
          </div>
        </div>
      </section>

      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card mb-5 mt-3">
                <section class="content-header" style="background-color: #D6EAF8;">
                  <div class="container-fluid">
                    <div class="row mb-2">
                      <div class="col-sm-6">
                        <h1>Registros almacenados</h1>
                      </div>
                    </div>
                  </div>
                </section>
                <div class="card-body">
                  <div class="row d-block mb-xxl-n2 mb-xl-n2 mb-lg-n2 mb-md-n2 mb-sm-n2 mb-1">
                      <?php foreach ($usuarios as $usuario) : ?>
                        <div class="col-auto mb-3">  
                          <a href="/users/update-sub?IdUsuario=<?php echo $usuario->IdUsuario ?>" class="btn btn-success" title="Premium"><i class="bi bi-cash"></i> <b style="color:#000000;">Pasarse a Premium</b> </a>
                        </div>
                      <?php endforeach; ?>
                    <?php
                    if ($usuarios > 0) : ?>
                      <div class="d-none col col-auto mb-1 d-flex justify-content-center justify-content-xl-start justify-content-xxl-start justify-content-lg-start justify-content-md-start justify-content-sm-start">
                        <a href="/users/create" class="btn btn-outline-primary mb-2"> <i class="fa-solid fa-user-plus"></i> <b>Nuevo Usuario</b> </a>
                      </div>
                    <?php endif; ?>
                  </div>
                  <table id="example1" class="table table-bordered table-hover">
                    <thead class="table-light">
                      <tr>
                        <th>Nombre</th>
                        <th>Apellido (s)</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($usuarios as $usuario) : ?>
                        <tr>
                          <td><?php echo $usuario->NombreUser ?></td>
                          <td><?php echo $usuario->Apellido1 . ' ' . $usuario->Apellido2 ?></td>
                          <td>
                            <div class="d-grid gap-2 d-inline-flex">
                              <a href="/users/update?IdUsuario=<?php echo $usuario->IdUsuario ?>" class="btn btn-outline-warning" title="Editar Usuario"> <i class="fas fa-user-edit"></i> <b style="color:#000000;">Editar Usuario</b> </a>
                              <a href="/users/update-pass?IdUsuario=<?php echo $usuario->IdUsuario ?>" class="btn btn-outline-warning" title="Editar Contraseña"><i class="fas fa-user-shield"></i> <b style="color:#000000;">Editar Contraseña</b> </a>
                            </div>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
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