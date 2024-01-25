<?php
include_once '/build/Sidebar.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Somos Hojancha</title>
    <link rel="stylesheet" href="//build/FontFamily_admin_section/fontfamily.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="//build/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="//build/assets/css/stl_AllReadonly.css">
    <link rel="stylesheet" href="//build/sweetalert2@11.1.4/sweetalert2.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content-header mb-3" style="background-color: #80D0C7;">
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
                            <div class="card" style="border-radius: 7px; background: #F8F8FF;">
                                <form id="regiration_form">
                                    <div class="card-header" style="background-color: #D6EAF8;">
                                        <h2 class="card-title" style="font-size: 23px;"><strong>Eliminar:</strong> Datos de la finca</h2>
                                    </div>
                                    <div class="card-body">
                                        <fieldset>
                                            <div class="col col-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="raza">Nombre de la finca</label>
                                                    <input disabled class="form-control" type="text" id="nombre" name="finca[NombreFinca]" autofocus onKeyUp="javascript:validateTextUbi('nombre')" placeholder="Escriba aquí el nombre de la finca" value="<?php echo s($finca->NombreFinca); ?>">
                                                </div>
                                            </div>
                                            <div class="col col-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="raza">Ubicación de la finca</label>
                                                    <input disabled class="form-control" type="text" id="ubicacion" name="finca[Ubicacion]" onKeyUp="javascript:validateTextUbi('ubicacion')" placeholder="Escriba aquí la ubicación" value="<?php echo s($finca->Ubicacion); ?>">
                                                </div>
                                            </div>
                                            <div class="col col-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="raza">Tamaño de la finca</label>
                                                    <input disabled class="form-control" type="text" id="tamano" name="finca[Tamano]" onKeyUp="javascript:validateTextUbi('tamano')" placeholder="Escriba aquí el tamaño" value="<?php echo s($finca->Tamano); ?>">
                                                </div>
                                            </div>
                                            <div class="col col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="usuario">Usuario</label>
                                                    <select disabled class="form-control" name="finca[FKUsuario]" id="usuario">
                                                        <?php foreach ($usuario as $usuario) : ?>
                                                            <option <?php echo $finca->IdFinca === $usuario->IdUsuario ? 'selected' : ''; ?> value="<?php echo s($usuario->IdUsuario); ?>"> <?php echo s($usuario->NombreUser); ?> </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="btn-spinner">
                                                <a href="/finca/index" class="btn btn-outline-danger col-auto me-2 col-xl-2 col-lg-2 col-md-2 col-sm-2 mt-1 mb-1"> <i class="fas fa-times-circle"></i> <b>Cerrar</b> </a>
                                                <a class="btn btn-outline-dark col-auto me-2 col-xl-2 col-lg-2 col-md-2 col-sm-2 mt-1 mb-1" onclick="eliminarFinca(<?php echo $finca->IdFinca ?>)"> <i class="fa-solid fa-trash-can"></i> <b> Eliminar</b></a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script src="//build/assets/js/stl_AllDelete.js"></script>
    <script src="//build/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="//build/jquery/jquery-3.3.1.min.js"></script>
    <script src="//build/sweetalert2@11.1.4/sweetalert2.js"></script>
</body>

</html>