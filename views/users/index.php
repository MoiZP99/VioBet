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
                <section class="content-header bg-gradient-success">
                  <div class="container-fluid">
                    <div class="row mb-2">
                      <div class="col-sm-6">
                        <h1 style="color: #FFFFFF;">Registros almacenados</h1>
                      </div>
                    </div>
                  </div>
                </section>
                <div class="card-body">
                  <div class="row d-block mb-xxl-n2 mb-xl-n2 mb-lg-n2 mb-md-n2 mb-sm-n2">
                    <div class="col col-auto mb-1 d-flex justify-content-center justify-content-xl-start justify-content-xxl-start justify-content-lg-start justify-content-md-start justify-content-sm-start">
                      <a href="/users/create" class="btn btn-outline-primary mb-2"> <i class="fa-solid fa-user-plus"></i> <b>Nuevo Usuario</b> </a>
                    </div>
                  </div>
                  <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Rol de usuario</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($usuarios as $usuario) : ?>
                        <tr>
                          <?php if ($usuario->Rol_Id == '3') : ?>
                            <td style="color: red;"><b><?php echo $usuario->Id ?></b></td>
                          <?php else : ?>
                            <td><b><?php echo $usuario->Id ?></b></td>
                          <?php endif; ?>
                          <td><?php echo $usuario->Nombre . ' ' . $usuario->Apellido1 . ' ' . $usuario->Apellido2 ?></td>
                          <td><?php echo $usuario->Nombre_Rol ?></td>
                          <td>
                            <?php if ($usuario->Estado == 'Activo') {
                              if ($usuario->Rol_Id == 3) {
                                echo '<span class="badge badge-success"> <i class="fas fa-lock-open"></i> Activo por defecto</span>';
                              } else {
                                echo '<span class="badge badge-success"> <i class="fas fa-lock-open"></i> Activo</span>';
                              }
                            } else if ($usuario->Estado == 'Inactivo') {
                              echo '<span class="badge badge-danger"> <i class="fas fa-lock"></i> Inactivo</span>';
                            } ?>
                          </td>
                          <?php if ($usuario->Rol_Id == 3) : ?>
                            <td>
                              <div class="d-grid gap-2 d-inline-flex d-none"></div>
                            </td>
                          <?php else : ?>
                            <td>
                              <div class="d-grid gap-2 d-inline-flex">
                                <a href="/users/update?Id=<?php echo $usuario->Id ?>" class="btn btn-outline-warning" title="Editar Usuario"> <i class="fas fa-user-edit"></i> <b style="color:#000000;">Editar Usuario</b> </a>
                                <a href="/users/update-pass?Id=<?php echo $usuario->Id ?>" class="btn btn-outline-warning" title="Editar Contraseña"><i class="fas fa-user-shield"></i> <b style="color:#000000;">Editar Contraseña</b> </a>
                              </div>
                            </td>
                          <?php endif; ?>
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