<?php
include_once 'public/build/Sidebar.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content-header mb-3" style="background-color: #80D0C7;">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Sección Inicial</h1>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <section class="col-12">
                            <div class="card" style="background-color: #D6EAF8;">
                                <div class="card-header border-0">
                                    <h3 class="card-title">
                                        <i class="far fa-calendar-alt"></i>
                                        Vista total de información almacenada.
                                    </h3>
                                </div>
                            </div>
                        </section>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-12">
                            <div class="small-box bg-gradient-info">
                                <?php if (count($animal) > 0) : ?>
                                    <div class="inner">
                                        <h3><?php echo count($animal) ?> <sup style="font-size: 20px">Registros totales</sup></h3>
                                        <p>Animales</p>
                                    </div>
                                <?php elseif (count($animal) === 0) : ?>
                                    <div class="inner">
                                        <h3>0 <sup style="font-size: 20px">Registros totales</sup></h3>
                                        <p>Animales</p>
                                    </div>
                                <?php endif ?>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="/animal/index" class="small-box-footer pt-3 pb-3">Ir a la tabla <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="small-box bg-gradient-success">
                                <?php if (count($finca) > 0) : ?>
                                    <div class="inner">
                                        <h3><?php echo count($finca) ?> <sup style="font-size: 20px">Registros totales</sup></h3>
                                        <p>Finca</p>
                                    </div>
                                <?php elseif (count($finca) === 0) : ?>
                                    <div class="inner">
                                        <h3>0 <sup style="font-size: 20px">Registros totales</sup></h3>
                                        <p>Finca</p>
                                    </div>
                                <?php endif ?>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="/finca/index" class="small-box-footer pt-3 pb-3">Ir a la tabla <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <?php if ($_SESSION['rol']) : ?>
                        <div class="col-lg-4 col-12">
                            <div class="small-box bg-gradient-warning bg-gradient-lightblue">
                                <?php if (count($usuarios) > 0) : ?>
                                    <div class="inner">
                                        <h3><?php echo count($usuarios) ?> <sup style="font-size: 20px">Registros totales</sup></h3>
                                        <p>Usuarios</p>
                                    </div>
                                <?php elseif (count($usuarios) === 0) : ?>
                                    <div class="inner">
                                        <h3>0 <sup style="font-size: 20px">Registros totales</sup></h3>
                                        <p>Usuarios</p>
                                    </div>
                                <?php endif ?>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="/users/index" class="small-box-footer">Ir a la tabla <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <div class="col-lg-6 col-12">
                            <div class="small-box bg-gradient-danger">
                                <?php if (count($actividad) > 0) : ?>
                                    <div class="inner">
                                        <h3><?php echo count($actividad) ?> <sup style="font-size: 20px">Registros totales</sup></h3>
                                        <p>Actividades</p>
                                    </div>
                                <?php elseif (count($actividad) === 0) : ?>
                                    <div class="inner">
                                        <h3>0 <sup style="font-size: 20px">Registros totales</sup></h3>
                                        <p>Actividades</p>
                                    </div>
                                <?php endif ?>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="/activities/index" class="small-box-footer">Ir a la tabla <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="small-box bg-gradient-blue">
                                <?php if (count($emprendedores) > 0) : ?>
                                    <div class="inner">
                                        <h3><?php echo count($emprendedores) ?> <sup style="font-size: 20px">Registros totales</sup></h3>
                                        <p>Emprendedores</p>
                                    </div>
                                <?php elseif (count($emprendedores) === 0) : ?>
                                    <div class="inner">
                                        <h3>0 <sup style="font-size: 20px">Registros totales</sup></h3>
                                        <p>Emprendedores</p>
                                    </div>
                                <?php endif ?>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="/entrepreneurs/index" class="small-box-footer">Ir a la tabla <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

</body>

</html>