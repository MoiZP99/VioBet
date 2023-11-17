<?php
include_once 'public/build/Sidebar.php';
// session_start();
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
                            <h1>Gestión de cruces</h1>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card" style="border-radius: 7px; background: #F8F8FF;">
                                <form method="POST" action="index" id="regiration_form">
                                    <div class="card-header" style="background-color: #D6EAF8;">
                                        <h2 class="card-title" style="font-size: 23px;"><strong>Datos del cruce</strong></h2>
                                    </div>
                                    <div class="card-body">
                                        <fieldset>
                                            <div class="row">
                                                <div class="col col-xxl-6 col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="RazaMadre">Raza del padre</label>
                                                        <select required class="form-select" autofocus name="dtCruce[RazaMadre]" id="RazaMadre">
                                                            <option selected disabled>Seleccione aquí</option>
                                                            <option value="Angus" <?php echo ($selectedRazaPadre == 'Angus') ? 'selected' : ''; ?>>Angus</option>
                                                            <option value="Holstein" <?php echo ($selectedRazaPadre == 'Holstein') ? 'selected' : ''; ?>>Holstein</option>
                                                            <option value="Charolais" <?php echo ($selectedRazaPadre == 'Charolais') ? 'selected' : ''; ?>>Charolais</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col col-xxl-6 col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="RazaPadre">Raza de la madre</label>
                                                        <select required class="form-select" autofocus name="dtCruce[RazaPadre]" id="RazaPadre">
                                                            <option selected disabled>Seleccione aquí</option>
                                                            <option value="Angus" <?php echo ($selectedRazaMadre == 'Angus') ? 'selected' : ''; ?>>Angus</option>
                                                            <option value="Holstein" <?php echo ($selectedRazaMadre == 'Holstein') ? 'selected' : ''; ?>>Holstein</option>
                                                            <option value="Charolais" <?php echo ($selectedRazaMadre == 'Charolais') ? 'selected' : ''; ?>>Charolais</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col col-xxl-6 col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="PurezaPadre">% de pureza del padre</label>
                                                        <select required class="form-select" autofocus name="dtCruce[PurezaPadre]" id="PurezaPadre">
                                                            <option selected disabled>Seleccione aquí</option>
                                                            <!-- <option value="25">25</option>
                                                            <option value="50">50</option>
                                                            <option value="75">75</option>
                                                            <option value="100">100</option> -->
                                                            <option value="25" <?php echo ($selectedPurezaPadre == '25') ? 'selected' : ''; ?>>25</option>
                                                            <option value="50" <?php echo ($selectedPurezaPadre == '50') ? 'selected' : ''; ?>>50</option>
                                                            <option value="75" <?php echo ($selectedPurezaPadre == '75') ? 'selected' : ''; ?>>75</option>
                                                            <option value="100" <?php echo ($selectedPurezaPadre == '100') ? 'selected' : ''; ?>>100</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col col-xxl-6 col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="PurezaMadre">% de pureza de la madre</label>
                                                        <select required class="form-select" autofocus name="dtCruce[PurezaMadre]" id="PurezaMadre">
                                                            <option selected disabled>Seleccione aquí</option>
                                                            <!-- <option value="25">25</option>
                                                            <option value="50">50</option>
                                                            <option value="75">75</option>
                                                            <option value="100">100</option> -->
                                                            <option value="25" <?php echo ($selectedPurezaMadre == '25') ? 'selected' : ''; ?>>25</option>
                                                            <option value="50" <?php echo ($selectedPurezaMadre == '50') ? 'selected' : ''; ?>>50</option>
                                                            <option value="75" <?php echo ($selectedPurezaMadre == '75') ? 'selected' : ''; ?>>75</option>
                                                            <option value="100" <?php echo ($selectedPurezaMadre == '100') ? 'selected' : ''; ?>>100</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col col-12">
                                                    <div class="mb-3">
                                                        <input type="hidden" name="resultado1" value="<?php echo $resultado1; ?>">
                                                        <input type="hidden" name="resultado2" value="<?php echo $resultado2;?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <button class="btn btn-primary col-auto col-xl-2 col-lg-2 col-md-2 col-sm-2 mt-1 mb-1 mx-2" type="submit" id="submit_data"> <b>Calcular</b></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card">
                                <div class="row">
                                    <div class="card-body">
                                        <div class="col col-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="Resultado1">Aporte sanguíneo del padre</label>
                                            <input type="text" class="form-control" id="Resultado1" name="resultado1" value="<?php echo $resultado1; ?>%" disabled>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="Resultado2">Aporte sanguíneo de la madre</label>
                                            <input type="text" class="form-control" id="Resultado2" name="resultado2" value="<?php echo $resultado2; ?>%" disabled>
                                        </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

</body>

</html>