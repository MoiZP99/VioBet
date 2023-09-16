<?php
include_once 'public/build/Sidebar.php';
session_start();
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
                            <h1>Sección de Lugares Turísticos</h1>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-5 mt-3">
                                <section class="content-header bg-gradient-warning">
                                    <div class="container-fluid">
                                        <div class="row mb-2">
                                            <div class="col-sm-6">
                                                <h1 style="color: #FFFFFF;">Solicitudes Ingresadas</h1>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <div class="card-body">
                                    <table id="example3" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Imagen</th>
                                                <th>Categoría</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($lugarSolicitud as $lugarSoli) : ?>
                                                <tr>
                                                    <td><b><?php echo $lugarSoli->Id ?></b></td>
                                                    <td><?php echo $lugarSoli->Nombre_Lugar ?></td>
                                                    <td><img style="width: 6rem;" src="/imagenes/<?php echo $lugarSoli->Imagen ?>"></td>
                                                    <td><?php echo $lugarSoli->categoria_turismo ?></td>
                                                    <td>
                                                        <?php if ($lugarSoli->Estado == 'Solicitud') {
                                                            echo '<span class="badge badge-warning"> <i class="fas fa-exclamation-circle"></i> Solicitud</span>';
                                                        } ?>
                                                    </td>
                                                    <td>
                                                        <div class="d-grid gap-2 d-inline-flex">
                                                            <a href="/places/details?Id=<?php echo $lugarSoli->Id ?>" class="fa-regular fa-eye btn btn-outline-info" title="Detalles"></a>
                                                            <?php if ($_SESSION['rol']) : ?>
                                                                <a href="/places/update?Id=<?php echo $lugarSoli->Id ?>" class="fa-regular fa-pen-to-square btn btn-outline-warning" title="Actualizar"></a>
                                                                <a href="/places/delete?Id=<?php echo $lugarSoli->Id ?>" class="fa-solid fa-trash-can btn btn-outline-danger" title="Eliminar"></a>
                                                            <?php endif; ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer bg-gradient-gray"></div>
                            </div>
                            <div class="card">
                                <section class="content-header bg-gradient-success mb-2">
                                    <div class="container-fluid">
                                        <div class="row mb-2">
                                            <div class="col-sm-6">
                                                <h1>Registros activos e inactivos</h1>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <div class="card-body">
                                    <div class="row d-flex justify-content-center justify-content-xl-start justify-content-xxl-start justify-content-lg-start justify-content-md-start justify-content-sm-start mb-xxl-n2 mb-xl-n2 mb-lg-n2 mb-md-n2 mb-sm-n2">
                                        <?php if ($_SESSION['rol']) : ?>
                                            <div class="col col-auto mb-3">
                                                <a href="/places/create" class="btn btn-outline-primary"> <i class="fas fa-plus-circle"></i> <strong>Nuevo Lugar Turístico</strong></a>
                                            </div>
                                        <?php endif; ?>
                                        <div class="col col-auto d-flex justify-content-center justify-content-xl-start justify-content-xxl-start justify-content-lg-start justify-content-md-start justify-content-sm-start">
                                            <div class="form-group mb-3">
                                                <form action="report_excel" method="POST">
                                                    <button type="submit" class="btn btn-outline-success"><i class="fas fa-file-excel"></i><b> Excel</b> </button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col col-auto d-flex justify-content-center justify-content-xl-start justify-content-xxl-start justify-content-lg-start justify-content-md-start justify-content-sm-start">
                                            <div class="form-group mb-3">
                                                <form action="report_pdf" method="POST" id="myForm">
                                                    <div class="btn-group dropend">
                                                        <button type="button" id="PDFButton" class="btn btn-outline-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fas fa-print"></i><b> PDF</b>
                                                            <span id="spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="visibility: hidden;"></span>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li><button class="dropdown-item submitButton" type="submit" name="opcion" value="activo">Activos</button></li>
                                                            <li><button class="dropdown-item submitButton" type="submit" name="opcion" value="inactivo">Inactivos</button></li>
                                                            <li>
                                                                <hr class="dropdown-divider bg-danger">
                                                            </li>
                                                            <li><button class="dropdown-item submitButton" type="submit" name="opcion" value="todo">Todo</button></li>
                                                        </ul>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <table id="example1" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Imagen</th>
                                                <th>Categoría</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($lugares as $lugar) : ?>
                                                <tr>
                                                    <td><b><?php echo $lugar->Id ?></b></td>
                                                    <td><?php echo $lugar->Nombre_Lugar ?></td>
                                                    <td><img style="width: 6rem;" src="/imagenes/<?php echo $lugar->Imagen ?>"></td>
                                                    <td><?php echo $lugar->categoria_turismo ?></td>
                                                    <td>
                                                        <?php if ($lugar->Estado == 'Activo') {
                                                            echo '<span class="badge badge-success"> <i class="fas fa-lock-open"></i> Activo</span>';
                                                        } elseif ($lugar->Estado == 'Inactivo') {
                                                            echo '<span class="badge badge-danger"> <i class="fas fa-lock"></i> Inactivo</span>';
                                                        } ?>
                                                    </td>
                                                    <td>
                                                        <div class="d-grid gap-2 d-inline-flex">
                                                            <a href="/places/details?Id=<?php echo $lugar->Id ?>" class="fa-regular fa-eye btn btn-outline-info" title="Detalles"></a>
                                                            <?php if ($_SESSION['rol']) : ?>
                                                                <a href="/places/update?Id=<?php echo $lugar->Id ?>" class="fa-regular fa-pen-to-square btn btn-outline-warning" title="Actualizar"></a>
                                                                <a href="/places/delete?Id=<?php echo $lugar->Id ?>" class="fa-solid fa-trash-can btn btn-outline-danger" title="Eliminar"></a>
                                                            <?php endif; ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer bg-gradient-gray"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    
    <script>
        var submitting = false;

        document.getElementById('myForm').addEventListener('submit', function(event) {
            if (submitting) {
                event.preventDefault();
                return;
            }

            submitting = true;
            document.getElementById('spinner').style.visibility = 'visible';
            document.getElementById('PDFButton').disabled = true;
            var dropdownToggle = document.querySelector('.dropdown-toggle');
            dropdownToggle.disabled = true;

            setTimeout(function() {
                restoreState();
            }, 3000);
        });

        function restoreState() {
            document.getElementById('spinner').style.visibility = 'hidden';
            document.getElementById('PDFButton').disabled = false;
            var dropdownToggle = document.querySelector('.dropdown-toggle');
            dropdownToggle.disabled = false;
            submitting = false;
        }

        document.getElementById('myForm').addEventListener('error', function(event) {
            restoreState();
        });

        document.getElementById('myForm').addEventListener('abort', function(event) {
            restoreState();
        });
    </script>

</body>

</html>