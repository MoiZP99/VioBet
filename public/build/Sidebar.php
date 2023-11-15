<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BioVet</title>
  <!-- <link rel="shortcut icon" href="/public/build/assets/images/LogoS.webp">
  <meta name="image" content="/public/build/assets/images/LogoS.webp">
  <meta name="description" content="Este es un sistema donde se promociona al productor local, orientamos e incentivamos el turismo y bindamos información de divesas actividades del Cantón de Hojancha.">
  <meta name="author" content="Grupo de desarrolladores de la Universidad Nacional de CostaRica"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
  <link href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/b-2.3.6/kt-2.9.0/r-2.4.1/sp-2.1.2/datatables.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="/public/build/dist/css/adminlte.min.css">
  <link href="/public/build/assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="/public/build/assets/css/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="/public/build/assets/css/sweetalert2.css">
  <link rel="stylesheet" href="/public/build/assets/css/breezed.css">

  <style>
    thead {
      background-color: #6c757d;
      color: #fff;
    }

    .profile {
      display: flex;
      align-items: center;
    }

    .avatar span {
      color: white;
      padding: 0px;
      padding-left: 5.3px;
      padding-right: 5.3px;
      font-size: 20px;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      text-transform: uppercase;
      background-color: var(--avatar-color);
    }

    #user-email {
      font-weight: bold;
    }
  </style>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a href="#" class="nav-link" onclick="confirmarCerrarSesion()"> <i class="fa fa-power-off" style="color: red;"></i> Cerrar Sesión</a>
          </a>
        </li>
      </ul>
    </nav>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <a style="text-decoration: none;" class="brand-link">
        <i class="bi-back brand-image"></i>
        <span class="img-circle elevation-3">Nomb Finca</span>
      </a>

      <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <div class="avatar">
              <span id="avatar-letter" class="img-circle elevation-2"></span>
            </div>
          </div>
          <div class="info">
            <a style="text-decoration: none;" class="d-block" id="user-email"><?php echo $_SESSION['usuario']; ?></a>
          </div>
        </div>

        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item menu-open">
              <a href="/principal/index" class="nav-link ">
                <i class="nav-icon fas fa-home"></i>
                <p>
                  Inicio
                  <i class="right fas fa-angle-down"></i>
                </p>
              </a>
            </li>
            <li class="nav-item menu-open">
              <a href="#" class="nav-link ">
                <i class="nav-icon fas fa-arrow-circle-right"></i>
                <p>
                  Premium
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/payment/payment" class="nav-link">
                    <i class="far fa-edit nav-icon"></i>
                    <p>Realizar el pago</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item menu-open">
              <a href="#" class="nav-link ">
                <i class="nav-icon fas fa-arrow-circle-right"></i>
                <p>
                  Gestión de animales
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/animal/index" class="nav-link">
                    <i class="far fa-edit nav-icon"></i>
                    <p>Animales</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/fichamedica/index" class="nav-link">
                    <i class="far fa-edit nav-icon"></i>
                    <p>FichaMedica</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/dtCruce/index" class="nav-link">
                    <i class="far fa-edit nav-icon"></i>
                    <p>Cruce</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item menu-open">
              <a href="#" class="nav-link ">
                <i class="nav-icon fas fa-arrow-circle-right"></i>
                <p>
                  Módulo Fincas
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/finca/index" class="nav-link">
                    <i class="far fa-edit nav-icon"></i>
                    <p>Finca</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-arrow-circle-right"></i>
                <p>
                  Modulo Usuarios
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/users/index" class="nav-link">
                    <i class="far fa-edit nav-icon"></i>
                    <p>Usuarios</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
      </div>
    </aside>

    <aside class="control-sidebar control-sidebar-dark">
    </aside>
  </div>

  <script src="/public/build/assets/js/jquery-3.3.1.min.js"></script>
  <script src="/public/build/assets/js/sweetalert2.js"></script>
  <script src="/public/build/assets/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/b-2.3.6/kt-2.9.0/r-2.4.1/sp-2.1.2/datatables.min.js"></script>
  <script src="/public/build/dist/js/adminlte.min.js"></script>
  <script>
    function confirmarCerrarSesion() {
      Swal.fire({
        title: '¿Cerrar sesión?',
        text: '¿Está seguro de que desea cerrar la sesión?',
        icon: 'warning',
        showCancelButton: true,
        allowOutsideClick: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '<i class="fas fa-check"></i> Sí, cerrar sesión',
        cancelButtonText: '<i class="fas fa-times"></i> Cancelar',
        buttonsStyling: false,
        customClass: {
          confirmButton: 'btn btn-outline-danger mx-2',
          cancelButton: 'btn btn-outline-secondary'
        }
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = '/logout';
        }
      });
    }
  </script>

  <script type="text/javascript">
    $(function() {
      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });

    $.extend(true, $.fn.dataTable.defaults, {
      "language": {
        "decimal": ",",
        "thousands": ".",
        "info": "Mostrando registros del _START_ al _END_ de un total de _MAX_ registros.",
        "infoEmpty": "No hay registros disponibles",
        "infoPostFix": "",
        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
        "loadingRecords": "Cargando...",
        "lengthMenu": 'Mostrar _MENU_ registros por página',
        "paginate": {
          "first": "<i class='fa fa-angle-double-left'></i>",
          "last": "<i class='fa fa-angle-double-right'></i>",
          "next": "Siguiente",
          "previous": "Anterior"
        },
        "processing": "Procesando...",
        "search": "Buscar:",
        "searchPlaceholder": "Escriba para buscar",
        "zeroRecords": "No se encontraron resultados!.",
        "emptyTable": "No hay datos disponibles",
        "aria": {
          "sortAscending": ": Activar para ordenar la columna de manera ascendente",
          "sortDescending": ": Activar para ordenar la columna de manera descendente"
        },
        "select": {
          "rows": {
            _: '%d filas seleccionadas',
            0: 'clic fila para seleccionar',
            1: 'una fila seleccionada'
          }
        }
      },
      "pagingType": "full_numbers"
    });


    const avatarLetter = document.getElementById('avatar-letter');

    const userEmail = document.getElementById('user-email');

    const currentUserEmail = '<?php echo $_SESSION['usuario']; ?>';

    const colors = ['#4285F4', '#DB4437', '#F4B400', '#0F9D58'];

    const randomIndex = Math.floor(Math.random() * colors.length);
    const randomColor = colors[randomIndex];

    avatarLetter.textContent = currentUserEmail.charAt(0).toUpperCase();

    avatarLetter.style.backgroundColor = randomColor;

    userEmail.textContent = currentUserEmail;
  </script>
</body>

</html>