<?php
include_once 'public/build/Sidebar.php';
// session_start();
use Model\Animal;
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
                            <h1>Gestión de animales en la finca</h1>
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
                                                <h1>Total de animales en la base de datos BioVet</h1>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <div class="card-body">
                                    <div class="row d-flex justify-content-center justify-content-xl-start justify-content-xxl-start justify-content-lg-start justify-content-md-start justify-content-sm-start mb-xxl-n2 mb-xl-n2 mb-lg-n2 mb-md-n2 mb-sm-n2">
                                        <?php if (Animal::contar() >= 10) : ?>
                                            <div class="col col-auto mb-3">
                                                <a class="btn btn-outline-secondary"> <strong>Suscribase a Premium </strong> <i class="fas fa-dollar-sign"></i></a>
                                            </div>
                                        <?php else : ?>
                                            <div class="col col-auto mb-3">
                                                <a href="/animal/create" class="btn btn-outline-primary"> <i class="fas fa-plus-circle"></i> <strong>Nuevo animal</strong></a>
                                            </div>
                                        <?php endif; ?>
                                        <div class="col col-auto d-flex justify-content-center justify-content-xl-start justify-content-xxl-start justify-content-lg-start justify-content-md-start justify-content-sm-start">
                                            <div class="form-group mb-3">
                                                <form action="report_excel" method="POST">
                                                    <button type="submit" disabled class="btn btn-outline-success"><i class="fas fa-file-excel"></i><b> Excel</b> </button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col col-auto d-flex justify-content-center justify-content-xl-start justify-content-xxl-start justify-content-lg-start justify-content-md-start justify-content-sm-start">
                                            <div class="form-group mb-3">
                                                <form action="report_pdf" method="POST" id="myForm">
                                                    <div class="btn-group dropend">
                                                        <button disabled type="button" id="PDFButton" class="btn btn-outline-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fas fa-print"></i><b> PDF</b>
                                                            <span id="spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="visibility: hidden;"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" >
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
                                        <thead class="table-light">
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Tipo</th>
                                                <th>Tipo de Sangre</th>
                                                <th>Raza</th>
                                                <th>Número en arete</th>
                                                <th>Finca</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($animal as $animal) : ?>
                                                <tr>
                                                    <td><?php echo $animal->Nombre ?></td>
                                                    <td><?php echo $animal->Tipo ?></td>
                                                    <td><?php echo $animal->TipoSangre ?></td>
                                                    <td><?php echo $animal->Raza ?></td>
                                                    <td><?php echo $animal->Numero ?></td>
                                                    <td><?php echo $animal->NombreFinca ?></td>

                                                    <td>
                                                        <div class="d-grid gap-2 d-inline-flex">
                                                            <a href="/animal/details?IdAnimal=<?php echo $animal->IdAnimal ?>" class="btn btn-outline-info" title="Detalles"><i class="fa-regular fa-eye"></i></a>
                                                            <a href="/animal/update?IdAnimal=<?php echo $animal->IdAnimal ?>" class="btn btn-outline-warning" title="Actualizar"><i class="fa-regular fa-pen-to-square"></i></a>
                                                            <a href="/animal/delete?IdAnimal=<?php echo $animal->IdAnimal ?>" class="btn btn-outline-danger" title="Eliminar"><i class="fa-solid fa-trash-can"></i>
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