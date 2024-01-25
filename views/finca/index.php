<?php
include_once '/build/Sidebar.php';
// session_start();
use Model\Finca;
?>
<!DOCTYPE html>
<html lang="es">

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content-header mb-3" style="background-color: #80D0C7;">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Gestión de la finca</h1>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <section class="content-header mb-2" style="background-color: #D6EAF8;">
                                    <div class="container-fluid">
                                        <div class="row mb-2">
                                            <div class="col-sm-6">
                                                <h1>Total de fincas en la base de datos BioVet</h1>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <div class="card-body">
                                    <div class="row d-flex justify-content-center justify-content-xl-start justify-content-xxl-start justify-content-lg-start justify-content-md-start justify-content-sm-start mb-xxl-n2 mb-xl-n2 mb-lg-n2 mb-md-n2 mb-sm-n2">
                                        <?php if (Finca::contar() >= 1) : ?>
                                            <div class="col col-auto mb-3">
                                                <a class="btn btn-outline-secondary"> </i> <strong>Suscribase a Premium </strong><i class="fas fa-dollar-sign"></i></a>
                                            </div>
                                        <?php else : ?>
                                            <div class="col col-auto mb-3">
                                                <a href="/finca/create" class="btn btn-outline-primary"> <i class="fas fa-plus-circle"></i> <strong>Nueva finca</strong></a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <table id="example1" class="table table-bordered table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Ubicación</th>
                                                <th>Tamaño</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($finca as $finca) : ?>
                                                <tr>
                                                    <td><?php echo $finca->NombreFinca ?></td>
                                                    <td><?php echo $finca->Ubicacion ?></td>
                                                    <td><?php echo $finca->Tamano ?></td>

                                                    <td>
                                                        <div class="d-grid gap-2 d-inline-flex">
                                                            <a href="/finca/details?IdAnimal=<?php echo $finca->IFinca ?>" class="btn btn-outline-info" title="Detalles"><i class="fa-regular fa-eye"></i></a>
                                                            <a href="/finca/update?IdAnimal=<?php echo $finca->IdFinca ?>" class="btn btn-outline-warning" title="Actualizar"><i class="fa-regular fa-pen-to-square"></i></a>
                                                            <a href="/finca/delete?IdAnimal=<?php echo $finca->IdFinca ?>" class="btn btn-outline-danger" title="Eliminar"><i class="fa-solid fa-trash-can"></i>
                                                            </a>
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