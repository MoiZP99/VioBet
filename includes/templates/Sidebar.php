<?php
// if (!isset($_SESSION)) {
//   
// }
// session_start();
//----------------------------------------
// if (!isset($_SESSION['Id'])) {
//   session_start();
// }

// $email = $_SESSION['Usuario'];
// $rol = $_SESSION['Rol_Id'];
// $n_rol = $_SESSION['Nombre_Rol'];
// 
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Somos Hojancha</title>
  <link rel="shortcut icon" href="/assets/images/Hojancha/Logo_Sin Fondo_Negro.png">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">


</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <!-- <div class="preloader flex-column justify-content-center align-items-center">
  <img class="animation__shake" src="/assets/images/LogoS.png" alt="AdminLTELogo" height="60" width="60">
</div> -->

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
      <!-- <ul class="navbar-nav ml-auto">
        <li class="nav-item d-none d-sm-inline-block">
          <a href="../../cerrar-sesion.php" class="nav-link"> <i class="fa fa-power-off"></i> Cerrar Sesión</a>
        </li>
      </ul> -->

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a href="../../cerrar-sesion.php" class="nav-link"> <i class="fa fa-power-off"></i> Cerrar Sesión</a>
          </a>
        </li>
      </ul>
    </nav>

    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="../../inicio.php" style="text-decoration: none;" class="brand-link">
        <img src="/dist/img/LogoS.png" alt="Logo_Zomos_Hojancha" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">Somos Hojancha</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="../../dist/img/perfil_email.png" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" style="text-decoration: none;" class="d-block">FALTA...</a>
          </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
            <li class="nav-item menu-open">
              <a href="#" class="nav-link ">
                <i class="nav-icon fas fa-arrow-circle-right"></i>
                <p>
                  Módulo Turismo
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/places/index" class="nav-link">
                    <i class="far fa-edit nav-icon"></i>
                    <p>Lugares Turísticos</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/cate_places/index" class="nav-link">
                    <i class="far fa-edit nav-icon"></i>
                    <p>Categoría</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link ">
                <i class="nav-icon fas fa-arrow-circle-right"></i>
                <p>
                  Módulo Gastronomía
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/admin/gastronomies/index.php" class="nav-link">
                    <i class="far fa-edit nav-icon"></i>
                    <p>Gastronomía</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/admin/cate_gastronomies/index.php" class="nav-link">
                    <i class="far fa-edit nav-icon"></i>
                    <p>Categoría</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link ">
                <i class="nav-icon fas fa-arrow-circle-right"></i>
                <p>
                  Módulo Actividades
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/admin/activities/index.php" class="nav-link">
                    <i class="far fa-edit nav-icon"></i>
                    <p>Actividades</p>
                  </a>
                </li>
              </ul>
            </li>
            <!-- </ul> -->
            <!-- </li> -->
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-arrow-circle-right"></i>
                <p>
                  Módulo Feria
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/admin/entrepreneurs/index.php" class="nav-link">
                    <i class="far fa-edit nav-icon"></i>
                    <p>Emprendedores</p>
                  </a>
                </li>
              </ul>
            </li>
            <!-- </ul> -->
            <!-- </li> -->
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
                  <a href="/admin/users/index.php" class="nav-link">
                    <i class="far fa-edit nav-icon"></i>
                    <p>Usuarios</p>
                  </a>
                </li>
                <!--<li class="nav-item">
                  <a href="" class="nav-link">
                    <i class="far fa-edit nav-icon"></i>
                    <p>Categorias Usuario</p>
                  </a>
                </li> -->
              </ul>
            </li>
            <!-- </ul>
          </li> -->

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <!-- <script src="/plugins/jszip/jszip.min.js"></script>
<script src="/plugins/pdfmake/pdfmake.min.js"></script>
<script src="/plugins/pdfmake/vfs_fonts.js"></script> -->
  <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.35/dist/sweetalert2.all.min.js"></script>

  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <!-- <script src="../../dist/js/demo.js"></script> -->

</body>

</html>