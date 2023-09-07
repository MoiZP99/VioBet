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
              <h1>Sección de Categorías: Lugares Turísticos</h1>
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
                  <div class="row d-block">
                      <?php if ($_SESSION['rol']) : ?>
                      <div class="col col-auto mb-1 d-flex justify-content-center justify-content-xl-start justify-content-xxl-start justify-content-lg-start justify-content-md-start justify-content-sm-start mb-xxl-n2 mb-xl-n2 mb-lg-n2 mb-md-n2 mb-sm-n2">
                      <a href="/cate_places/create" class="btn btn-outline-primary mb-2"> <i class="fas fa-plus-circle"></i> <b>Nueva Categoría</b> </a>
                    </div>
                    <?php endif; ?>
                    
                  </div>
                  <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Categoría</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($categorias as $categoria) : ?>
                        <tr>
                          <td><b><?php echo $categoria->Id ?></b></td>
                          <td><?php echo $categoria->categoria_turismo ?></td>
                          <td>
                            <div class="d-grid gap-2 d-inline-flex">
                                <?php if ($_SESSION['rol']) : ?>
                                <a href="/cate_places/update?Id=<?php echo $categoria->Id ?>" class="fa-regular fa-pen-to-square btn btn-outline-warning" title="Editar"></a>
                              <a onclick="eliminar(<?php echo $categoria->Id ?>)" class="fa-solid fa-trash-can btn btn-outline-danger" title="Eliminar"></a>
                                <?php endif; ?>
                              
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

  <script type="text/javascript">
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger mr-3'
      },
      buttonsStyling: false
    });

    function eliminar(elimino) {
      swalWithBootstrapButtons.fire({
        title: '¿Está seguro?',
        text: '¡No podrá revertir esto!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: '¡Sí, bórralo!',
        cancelButtonText: '¡No, cancelar!',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          llamado(elimino);
        } else if (result.dismiss === Swal.DismissReason.cancel) {
          swalWithBootstrapButtons.fire(
            'Cancelado',
            'Su registro está seguro',
            'error'
          );
        }
      });
    }

    function llamado(elimino) {
      const parametros = {
        Id: elimino
      };
      $.ajax({
        data: parametros,
        url: '/cate_places/delete',
        type: 'POST',
        beforeSend: function() {},
        success: function() {
          swalWithBootstrapButtons.fire(
            '¡Eliminado!',
            'Su registro ha sido eliminado.',
            'success'
          ).then((result) => {
            window.location.href = '/cate_places/index';
          });
        },
      });
    }
  </script>
</body>

</html>