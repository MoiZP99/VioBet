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
                            <h1>Sección Inicial</h1>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <section class="col-12">
                            <div class="card bg-gradient-success">
                                <div class="card-header border-0">
                                    <h3 class="card-title">
                                        <i class="far fa-calendar-alt"></i>
                                        Vista total de información almacenada y solicitudes ingresadas
                                    </h3>
                                </div>
                            </div>
                        </section>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="small-box bg-gradient-warning">
                                <?php if (count($emprendeSolicitud) > 0) : ?>
                                    <div class="inner">
                                        <div class="d-flex justify-content-between">
                                            <h3 style="color: #FFFFFF;"><?php echo count($emprendeSolicitud) ?> <sup style="font-size: 20px">Solicitudes ingresadas</sup></h3>
                                            <i style="color: #2E5857; margin-top: 10px;" class="fas fa-bell"> <span style="font-size: 10px; color: #DB4437;"><?php echo count($emprendeSolicitud) ?></span> </i>
                                        </div>
                                        <p style="color: #FFFFFF;">Solicitudes para emprendedores</p>
                                    </div>
                                <?php elseif (count($emprendeSolicitud) === 0) : ?>
                                    <div class="inner">
                                        <h3 style="color: #FFFFFF;">0 <sup style="font-size: 20px">Solicitudes ingresadas</sup></h3>
                                        <p style="color: #FFFFFF;">Solicitudes para emprendedores</p>
                                    </div>
                                <?php endif ?>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="/entrepreneurs/index" class="small-box-footer">Ir a la tabla <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="small-box bg-gradient-warning">
                                <?php if (count($lugarSolicitud) > 0) : ?>
                                    <div class="inner">
                                        <div class="d-flex justify-content-between">
                                            <h3 style="color: #FFFFFF;"><?php echo count($lugarSolicitud) ?> <sup style="font-size: 20px">Solicitudes ingresadas</sup></h3>
                                            <i style="color: #2E5857; margin-top: 10px;" class="fas fa-bell"> <span style="font-size: 10px; color: #DB4437;"><?php echo count($lugarSolicitud) ?></span> </i>
                                        </div>
                                        <p style="color: #FFFFFF;">Solicitudes para emprendedores</p>
                                    </div>
                                <?php elseif (count($lugarSolicitud) === 0) : ?>
                                    <div class="inner">
                                        <h3 style="color: #FFFFFF;">0 <sup style="font-size: 20px">Solicitudes ingresadas</sup></h3>
                                        <p style="color: #FFFFFF;">Solicitudes para lugares turísticos</p>
                                    </div>
                                <?php endif ?>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="/places/index" class="small-box-footer">Ir a la tabla <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="small-box bg-gradient-info">
                                <?php if (count($lugares) > 0) : ?>
                                    <div class="inner">
                                        <h3><?php echo count($lugares) ?> <sup style="font-size: 20px">Registros totales</sup></h3>
                                        <p>Lugares Turísticos</p>
                                    </div>
                                <?php elseif (count($lugares) === 0) : ?>
                                    <div class="inner">
                                        <h3>0 <sup style="font-size: 20px">Registros totales</sup></h3>
                                        <p>Lugares Turísticos</p>
                                    </div>
                                <?php endif ?>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="/places/index" class="small-box-footer">Ir a la tabla <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="small-box bg-gradient-success">
                                <?php if (count($gastronomias) > 0) : ?>
                                    <div class="inner">
                                        <h3><?php echo count($gastronomias) ?> <sup style="font-size: 20px">Registros totales</sup></h3>
                                        <p>Gastronomías</p>
                                    </div>
                                <?php elseif (count($gastronomias) === 0) : ?>
                                    <div class="inner">
                                        <h3>0 <sup style="font-size: 20px">Registros totales</sup></h3>
                                        <p>Gastronomías</p>
                                    </div>
                                <?php endif ?>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="/gastronomies/index" class="small-box-footer">Ir a la tabla <i class="fas fa-arrow-circle-right"></i></a>
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