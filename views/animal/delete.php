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
            <section class="content-header mb-3" style="background-color: #80D0C7;">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Animal</h1>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card" style="border-radius: 7px; background: #F8F8FF;">
                                <form method="POST" id="regiration_form">
                                    <div class="card-header" style="background-color: #D6EAF8;">
                                        <h2 class="card-title" style="font-size: 23px;"><strong>Detalles:</strong> Datos del animal</h2>
                                    </div>
                                    <div class="card-body">
                                        <fieldset>
                                            <div class="row">
                                                <div class="col col-xxl-6 col-xl-6 col-lg-6 col-sm-6 col-md-6 col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="tipo">Tipo de animal</label>
                                                        <select disabled class="form-control" autofocus name="animal[Tipo]" id="tipo">
                                                            <option disabled>Seleccione aquí</option>
                                                            <option value="Vaca" <?php echo ($animal->Tipo === 'Vaca') ? 'selected' : ''; ?>>Vaca</option>
                                                            <option value="Toro" <?php echo ($animal->Tipo === 'Toro') ? 'selected' : ''; ?>>Toro</option>
                                                            <option value="Caballo" <?php echo ($animal->Tipo === 'Caballo') ? 'selected' : ''; ?>>Caballo</option>
                                                            <option value="Yegua" <?php echo ($animal->Tipo === 'Yegua') ? 'selected' : ''; ?>>Yegua</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col col-xxl-6 col-xl-6 col-lg-6 col-sm-6 col-md-6 col-12">
                                                  <div class="mb-3">
                                                       <label class="form-label" for="raza">Tipo de Sangre</label>
                                                         <input disabled class="form-control" type="text" id="tiposangre" name="animal[TipoSangre]" onKeyUp="javascript:validateTextUbi('raza')" placeholder="Escriba aquí el tipo de sangre" value="<?php echo s($animal->TipoSangre); ?>">
                                                 </div>
                                                 </div>

                                                <div class="col col-xxl-6 col-xl-6 col-lg-6 col-sm-6 col-md-6 col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="raza">Raza del animal</label>
                                                        <input disabled class="form-control" type="text" id="raza" name="animal[Raza]" onKeyUp="javascript:validateTextUbi('raza')" placeholder="Escriba aquí la raza" value="<?php echo s($animal->Raza); ?>">
                                                    </div>
                                                </div>
                                                <div class="col col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="sexo">Sexo del animal</label>
                                                        <select disabled class="form-control" name="animal[Sexo]" id="sexo">
                                                            <option disabled>Seleccione aquí</option>
                                                            <option value="Macho" <?php echo ($animal->Sexo === 'Macho') ? 'selected' : ''; ?>>Macho</option>
                                                            <option value="Hembra" <?php echo ($animal->Sexo === 'Hembra') ? 'selected' : ''; ?>>Hembra</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="nombre">Nombre del animal</label>
                                                        <input disabled class="form-control" type="text" id="nombre" name="animal[Nombre]" onKeyUp="javascript:validateText('nombre')" placeholder="Esriba aquí el nombre" value="<?php echo s($animal->Nombre); ?>">
                                                    </div>
                                                </div>
                                                <div class="col col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="edad">Edad del animal</label>
                                                        <input disabled class="form-control" type="int" id="edad" name="animal[Edad]" onKeyUp="javascript:validateTextUbi('edad')" placeholder="Escriba aquí la edad" value="<?php echo s($animal->Edad); ?>">
                                                    </div>
                                                </div>
                                                <div class="col col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="peso">Peso del animal (Kg)</label>
                                                        <input disabled class="form-control" type="int" id="peso" name="animal[Peso]" onKeyUp="javascript:validateTextUbi('peso')" placeholder="Escriba aquí el peso" value="<?php echo s($animal->Peso); ?>">
                                                    </div>
                                                </div>
                                                <div class="col col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="numero">Número en arete del animal</label>
                                                        <input disabled class="form-control" type="int" id="numero" name="animal[Numero]" onKeyUp="javascript:validateTextUbi('numero')" placeholder="Escriba aquí el número" value="<?php echo s($animal->Numero); ?>">
                                                    </div>
                                                </div>

                                 
                                                <div class="col col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="finca">Finca</label>
                                                        <select disabled class="form-control" name="animal[FKFinca]" id="finca">
                                                            <option disabled>Seleccione aquí</option>
                                                            <?php foreach ($finca as $finca) : ?>
                                                                <option <?php echo $animal->FKFinca === $finca->IdFinca ? 'selected' : ''; ?> value="<?php echo s($finca->IdFinca); ?>"> <?php echo s($finca->NombreFinca); ?> </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="btn-spinner">
                                                <a href="/animal/index" class="btn btn-outline-danger col-auto me-2 col-xl-2 col-lg-2 col-md-2 col-sm-2 mt-1 mb-1"> <i class="fas fa-times-circle"></i> <b>Cerrar</b> </a>
                                                <a class="btn btn-outline-dark col-auto me-2 col-xl-2 col-lg-2 col-md-2 col-sm-2 mt-1 mb-1" onclick="eliminarAnimal(<?php echo $animal->IdAnimal ?>)"> <i class="fa-solid fa-trash-can"></i> <b> Eliminar</b></a>
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

    <script src="/public/build/assets/js/stl_AllDelete.js"></script>
    <script src="/public/build/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/public/build/jquery/jquery-3.3.1.min.js"></script>
    <script src="/public/build/sweetalert2@11.1.4/sweetalert2.js"></script>
</body>

</html>