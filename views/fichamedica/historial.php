<?php
include_once '/build/Sidebar.php';
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
                            <h1>Historial de Fichas Medicas</h1>
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
                                                <h1>Historial de Fichas Medicas hasta la fecha</h1>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <div class="card-body">
                                    <div class="row d-flex justify-content-center justify-content-xl-start justify-content-xxl-start justify-content-lg-start justify-content-md-start justify-content-sm-start mb-xxl-n2 mb-xl-n2 mb-lg-n2 mb-md-n2 mb-sm-n2">
                                        <div class="col col-auto mb-3">
                                            <a href="/fichamedica/index" class="btn btn-outline-primary"> <i class="fas fa-backward"></i> <strong>Regresar</strong></a>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                            <?php
                            if ($historial) {
                                echo '<div class="row">';
                                    foreach ($historial as $resultado) {
                                        echo '<div class="col col-auto gap-4">';
                                            echo '<div class="card card-success">';
                                                echo '<div class="card-body">';
                                                    echo '<h5 class="card-title"><b>Nombre:</b> ' . $resultado->Nombre . '</h5>';
                                                    echo '<p class="card-text">Raza: ' . $resultado->Raza . '</p>';
                                                    echo '<p class="card-text">Sexo: ' . $resultado->Sexo . '</p>';
                                                    echo '<p class="card-text">Tipo de Medicamento: ' . $resultado->TipoMedicamento . '</p>';
                                                  
                                                    echo '<p class="card-text">Antecedentes: ' . $resultado->Antecedentes . '</p>';
                                                    echo '<p class="card-text">Síntomas: ' . $resultado->Sintomas . '</p>';
                                                    echo '<p class="card-text">Diagnóstico: ' . $resultado->Diagnostico . '</p>';
                                                    echo '<p class="card-text">Detalle del Medicamento: ' . $resultado->DetalleMedicamento . '</p>';
                                                    echo '<p class="card-text">Fecha de Revisión: ' . date_format(date_create($resultado->FechaRevision), 'd-m-Y') . '</p>';
                                                echo '</div>';
                                            echo '</div>';
                                        echo '</div>';
                                    }
                                echo '</div>';
                            } else {
                                echo 'No se encontraron resultados.';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

</body>

</html>