<?php

namespace Controllers;

use MVC\Router;
use Model\FichaMedica;
use Model\Animal;
use Model\Historial;

class FichaMedicaController
{
    public static function index(Router $router)
    {
        $fichamedica = FichaMedica::innerJoin();
        // $historial = Historial::all();

        $router->render('/fichamedica/index', [
            'fichamedica' => $fichamedica
            // 'historial' => $historial
        ]);
    }

    public static function create(Router $router)
    {
        session_start();

        $fichamedica = new FichaMedica();
        $animal = Animal::all();
        $errores = FichaMedica::getErrores();
        $ErrVac = FichaMedica::getErrVac();
        $ErrAnte = FichaMedica::getErrAnte();
        $ErrSinto = FichaMedica::getErrSinto();
        $ErrDiagno = FichaMedica::getErrDiagno();
        $ErrMedi = FichaMedica::getErrMedi();
        $ErrFecha = FichaMedica::getErrFecha();
        $ErrFKAnimal = FichaMedica::getErrFKAnimal();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //coemtnrairo
            $fichamedica = new FichaMedica($_POST['fichamedica']);

            $errores = $fichamedica->validar();
            $ErrVac = $fichamedica->validaTipoMedicamento();
            $ErrAnte = $fichamedica->validaAntecedentes();
            $ErrSinto = $fichamedica->validaSintomas();
            $ErrDiagno = $fichamedica->validaDiagnostico();
            $ErrMedi = $fichamedica->validaMedicamento();
            $ErrFecha = $fichamedica->validaFecha();
            $ErrFKAnimal = $fichamedica->validaAnimal();

            if (empty(($errores) || ($ErrVac) || ($ErrAnte) || ($ErrSinto) || ($ErrDiagno) || ($ErrMedi) || ($ErrFecha) || ($ErrFKAnimal))) {
                $fichamedica->guardar();
                if ($fichamedica) {
                    $_SESSION['success_message'] = ['title' => '¡Éxito! Datos del animal guardados exitosamente'];
                    header('Location: /fichamedica/create');
                    exit;
                }
            }
        }

        $router->render('/fichamedica/create', [
            'errores' => $errores,
            'ErrVac' => $ErrVac,
         
            'ErrAnte' => $ErrAnte,
            'ErrSinto' => $ErrSinto,
            'ErrDiagno' => $ErrDiagno,
            'ErrMedi' => $ErrMedi,
            'ErrFecha' => $ErrFecha,
            'ErrFKAnimal' => $ErrFKAnimal,
            'fichamedica' => $fichamedica,
            'animal' => $animal,
        ]);
    }


    public static function update(Router $router)
    {
        $IdFichaMedica = validarORedireccionarFichaMedica('/fichamedica/index');

        $fichamedica = FichaMedica::find($IdFichaMedica);
        $animal = Animal::all1();

        $errores = FichaMedica::getErrores();
        $ErrVac = FichaMedica::getErrVac();
       
        $ErrAnte = FichaMedica::getErrAnte();
        $ErrSinto = FichaMedica::getErrSinto();
        $ErrDiagno = FichaMedica::getErrDiagno();
        $ErrMedi = FichaMedica::getErrMedi();
        $ErrFecha = FichaMedica::getErrFecha();
        $ErrFKAnimal = FichaMedica::getErrFKAnimal();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $args = $_POST['fichamedica'];

            $fichamedica->sincronizar($args);

            $errores = $fichamedica->validar();
            $ErrVac = $fichamedica->validaTipoMedicamento();
            $ErrAnte = $fichamedica->validaAntecedentes();
            $ErrSinto = $fichamedica->validaSintomas();
            $ErrDiagno = $fichamedica->validaDiagnostico();
            $ErrMedi = $fichamedica->validaMedicamento();
            $ErrFecha = $fichamedica->validaFecha();
            $ErrFKAnimal = $fichamedica->validaAnimal();

            if (empty(($errores) || ($ErrVac) || ($ErrAnte) || ($ErrSinto) || ($ErrDiagno) || ($ErrMedi) || ($ErrFecha) || ($ErrFKAnimal))) {
                $fichamedica->guardar();
            }
        }

        $router->render('/fichamedica/update', [
            'errores' => $errores,
            'ErrVac' => $ErrVac,
            'ErrAnte' => $ErrAnte,
            'ErrSinto' => $ErrSinto,
            'ErrDiagno' => $ErrDiagno,
            'ErrMedi' => $ErrMedi,
            'ErrFecha' => $ErrFecha,
            'ErrFKAnimal' => $ErrFKAnimal,
            'fichamedica' => $fichamedica,
            'animal' => $animal
        ]);
    }


    public static function details(Router $router)
    {
        $IdFichaMedica = validarORedireccionarFichaMedica('/fichamedica/index');

        $fichamedica = FichaMedica::find($IdFichaMedica);
        $animal = Animal::all1();

        $router->render('/fichamedica/details', [
            'fichamedica' => $fichamedica,
            'animal' => $animal
        ]);
    }

    public static function delete(Router $router)
    {
        $IdFichaMedica = validarORedireccionarFichaMedica('/fichamedica/index');

        $fichamedica = FichaMedica::find($IdFichaMedica);

        // $resultadodiasl = Dayl::allDias();

        $router->render('/fichamedica/delete', [
            'fichamedica' => $fichamedica
            // ,
            // 'resultadodiasl' => $resultadodiasl
        ]);
    }

    public static function delete_partial(Router $router)
    {
        $IdFichaMedica = $_POST['IdFichaMedica'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $IdFichaMedica = filter_var($IdFichaMedica, FILTER_VALIDATE_INT);
            if ($IdFichaMedica) {
                $fichamedica = FichaMedica::find($IdFichaMedica);
                $fichamedica->eliminar();
            }
        }

        $router->render('/fichamedica/delete/delete_partial', [
            'fichamedica' => $fichamedica
        ]);
    }


    public static function report_excel(Router $router)
    {
        $fichamedica = FichaMedica::innerJoin();

        $router->render('fichamedica/report_excel', [
            'fichamedica' => $fichamedica
        ]);
    }

    public static function report_pdf(Router $router)
    {
        $opcion = isset($_POST['opcion']) ? $_POST['opcion'] : 'todo';

        $reportPDF = FichaMedica::innerPDF($opcion);

        $router->render('fichamedica/report_pdf', [
            'reportPDF' => $reportPDF
        ]);
    }
}
