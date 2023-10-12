<?php
include_once 'public/build/Sidebar.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Somos Hojancha</title>
    <link rel="stylesheet" href="/public/build/FontFamily_admin_section/fontfamily.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="/public/build/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/build/assets/css/stl_AllReadonly.css">
    <link rel="stylesheet" href="/public/build/sweetalert2@11.1.4/sweetalert2.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Lugares Turísticos</h1>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-success" style="border-radius: 7px; background: #F8F8FF;">
                                <div class="card-header" style="background-color: #13701C;">
                                    <h2 class="card-title" style="font-size: 20px;"><strong>Eliminar</strong>: Lugar Turístico</h2>
                                </div>
                                <div class="card-body">
                                    <form enctype="multipart/form-data">
                                        <fieldset>
                                            <div class="row">
                                                <div class="col col-xxl-4 col-xl-4 col-lg-4 col-sm-6 col-md-4 col-12">
                                                    <div class="mb-4">
                                                        <label class="form-label"><strong>Nombre</strong></label>
                                                        <input class="form-control" type="text" disabled value="<?php echo s($lugar->Nombre_Lugar); ?>">
                                                    </div>
                                                </div>
                                                <div class="col col-xxl-4 col-xl-4 col-lg-4 col-sm-6 col-md-4 col-12">
                                                    <div class="mb-4">
                                                        <label class="form-label"><strong>Tipo de lugar</strong></label>
                                                        <select disabled class="form-control">
                                                            <?php foreach ($resultadoespacio as $espacio) : ?>
                                                                <option <?php echo $lugar->TipoEspacio_Id === $espacio->Id ? 'selected' : ''; ?> disabled value="<?php echo s($espacio->Id); ?>"> <?php echo s($espacio->Espacio); ?> </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col col-xxl-4 col-xl-4 col-lg-4 col-sm-6 col-md-4 col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label"><strong>Descripción</strong></label>
                                                        <textarea class="form-control" rows="8" style="overflow: hidden; resize: none;" onkeypress="auto_grow(this);" onkeyup="auto_grow(this);" disabled><?php echo s($lugar->Descripcion); ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col col-xxl-8 col-xl-8 col-lg-8 col-sm-6 col-md-8 col-12 ubi">
                                                    <div class="mb-3">
                                                        <label class="form-label"><strong>Ubicación</strong></label>
                                                        <textarea class="form-control" rows="2" style="overflow: hidden; resize: none;" onkeypress="auto_grow(this);" onkeyup="auto_grow(this);" disabled><?php echo s($lugar->Ubicacion); ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col col-xl-4 col-xxl-4 col-lg-4 col-md-4 col-sm-6 col-6">
                                                    <div class="mb-3">
                                                        <label class="form-label"><strong>Hora de cierre</strong></label>
                                                        <input class="form-control" type="time" disabled value="<?php echo s($lugar->Hora_clausura); ?>">
                                                    </div>
                                                </div>
                                                <div class="col col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6">
                                                    <div class="mb-3">
                                                        <label class="form-label"><strong>Hora de apertura</strong></label>
                                                        <input class="form-control" type="time" disabled value="<?php echo s($lugar->Hora_apertura); ?>">
                                                    </div>
                                                </div>
                                                <div class="col col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="imagen"><strong>Imagen</strong></label>
                                                        <div class="row">
                                                            <?php if ($lugar->Imagen) { ?>
                                                                <img src="/imagenes/<?php echo $lugar->Imagen ?>">
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col col-xxl-4 col-xl-4 col-lg-4 col-sm-6 col-md-4 col-12 cate">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="categoria"><strong>Categoría</strong></label>
                                                        <select disabled class="form-control" aria-label="rol" id="categoria">
                                                            <?php foreach ($resultadocategoria as $categoria_lugar) : ?>
                                                                <option <?php echo $lugar->$categoria_Id === $categoria_lugar->Id ? 'selected' : ''; ?> value="<?php echo s($categoria_lugar->Id); ?>"> <?php echo s($categoria_lugar->categoria_turismo); ?> </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col col-xxl-4 col-xl-4 col-lg-4 col-sm-4 col-md-4 col-12 cate">
                                                    <div class="mb-3">
                                                        <label disabled class="form-label">Estado</label>
                                                        <select disabled class="form-control">
                                                            <?php foreach ($resultadoestado as $estado) : ?>
                                                                <option <?php echo $lugar->FK_Estado === $estado->Id ? 'selected' : ''; ?> value="<?php echo s($estado->Id); ?>"> <?php echo s($estado->Estado); ?> </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-sm-6 col-6">
                                                    <div class="mb-3">
                                                        <label class="form-label"><strong>Día de apertura</strong></label>
                                                        <select disabled class="form-control">
                                                            <?php foreach ($resultadodiasl as $dias) : ?>
                                                                <option <?php echo $lugar->DiaApertura_Id === $dias->Id ? 'selected' : ''; ?> disabled value="<?php echo s($dias->Id); ?>"> <?php echo s($dias->Nombre_Dial); ?> </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-sm-6 col-6">
                                                    <div class="mb-3">
                                                        <label class="form-label"><strong>Día de cierre</strong></label>
                                                        <select disabled class="form-control">
                                                            <?php foreach ($resultadodiasll as $dias2) : ?>
                                                                <option <?php echo $lugar->DiaClausura_Id === $dias2->Id ? 'selected' : ''; ?> disabled value="<?php echo s($dias2->Id); ?>"> <?php echo s($dias2->Nombre_Diall); ?> </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col col-xxl-3 col-xl-3 col-lg-6 col-sm-6 col-md-6 col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label"><strong>Número de teléfono</strong></label>
                                                        <input class="form-control" type="tel" disabled value="<?php echo s($lugar->Numero_Contacto); ?>">
                                                    </div>
                                                </div>
                                                <div class="col col-xxl-3 col-xl-3 col-lg-6 col-sm-6 col-md-6 col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label"><strong>Correo electrónico</strong></label>
                                                        <input class="form-control" type="email" disabled value="<?php echo s($lugar->Correo); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <hr style="background-color: green;">
                                        <a class="btn btn-outline-danger col-auto" onclick="eliminarLugar(<?php echo $lugar->Id ?>)"> <i class="fa-solid fa-trash-can"></i> <b> Eliminar</b></a>
                                        <a href="/places/index" class="btn btn-outline-primary col-auto col-xl-auto col-lg-auto col-md-auto col-sm-auto"> <i class="fas fa-times-circle"></i> <b>Cerrar</b> </a>
                                    </form>
                                </div>
                                <div class="card-footer"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script src="/public/build/assets/js/stl_AllDelete.js"></script>
    <script src="/public/build/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/public/build/jquery/jquery-3.3.1.min.js"></script>
    <script src="/public/build/sweetalert2@11.1.4/sweetalert2.js"></script>
</body>

</html>