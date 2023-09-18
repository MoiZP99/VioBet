<?php

namespace Controllers;

use MVC\Router;
use Model\Animal;

class AnimalController
{
    public static function index(Router $router)
    {
        $animal = Animal::innerJoin();
        // $lugarSolicitud = Animal::innerJoinSolicitud();

        $router->render('/animal/index', [
            'animal' => $animal
            // ,
            // 'lugarSolicitud' => $lugarSolicitud
        ]);
    }

    public static function create(Router $router)
    {
        session_start();

        $animal = new Animal();
        // $resultadoestado = Pasture::all();
        $errores = Animal::getErrores();
        $ErrNomb = Animal::getErrNomb();
        $ErrTipo = Animal::getErrTipo();
        $ErrRaza = Animal::getErrRaza();
        $ErrEdad = Animal::getErrEdad();
        $ErrSexo = Animal::getErrSexo();
        $ErrPeso = Animal::getErrPeso();
        $ErrNum = Animal::getErrNum();
        $ErrFKFinca = Animal::getErrFKFinca();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $animal = new Animal($_POST['animal']);

            $errores = $animal->validar();
            $ErrNomb = $animal->validaNombre();
            $ErrTipo = $animal->validaTipo();
            $ErrRaza = $animal->validaRaza();
            $ErrEdad = $animal->validaEdad();
            $ErrSexo = $animal->validaSexo();
            $ErrPeso = $animal->validaPeso();
            $ErrNum = $animal->validaNum();
            $ErrFKFinca = $animal->validaFinca();

            if (empty(($ErrNomb) || ($ErrTipo) || ($ErrRaza) || ($ErrEdad) || ($ErrSexo) || ($ErrPeso) || ($ErrNum) || ($ErrFKFinca))) {
                $animal->guardar();
                if ($animal) {
                    $_SESSION['success_message'] = ['title' => '¡Éxito! Datos del animal guardados exitosamente'];
                    header('Location: /animal/create');
                    exit;
                }
            }
        }

        $router->render('/animal/create', [
            'errores' => $errores,
            'ErrNomb' => $ErrNomb,
            'ErrTipo' => $ErrTipo,
            'ErrRaza' => $ErrRaza,
            'ErrEdad' => $ErrEdad,
            'ErrSexo' => $ErrSexo,
            'ErrPeso' => $ErrPeso,
            'ErrNum' => $ErrNum,
            'ErrFKFinca' => $ErrFKFinca,
            'animal' => $animal
            // ,'resultadodiasl' => $resultadodiasl,
        ]);
    }


    public static function update(Router $router)
    {
        $Id = validarORedireccionar('/animal/index');

        $animal = Animal::find($Id);


        // $resultadodiasl = Dayl::allDias();

        $errores = Animal::getErrores();
        $ErrNomb = Animal::getErrNomb();
        $ErrTipo = Animal::getErrTipo();
        $ErrRaza = Animal::getErrRaza();
        $ErrEdad = Animal::getErrEdad();
        $ErrSexo = Animal::getErrSexo();
        $ErrPeso = Animal::getErrPeso();
        $ErrNum = Animal::getErrNum();
        $ErrFKFinca = Animal::getErrFKFinca();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $args = $_POST['animal'];

            $animal->sincronizar($args);

            $errores = $animal->validar();
            $ErrNomb = $animal->validaNombre();
            $ErrTipo = $animal->validaTipo();
            $ErrRaza = $animal->validaRaza();
            $ErrEdad = $animal->validaEdad();
            $ErrSexo = $animal->validaSexo();
            $ErrPeso = $animal->validaPeso();
            $ErrNum = $animal->validaNum();
            $ErrFKFinca = $animal->validaFinca();

            if (empty(($ErrNomb) || ($ErrTipo) || ($ErrRaza) || ($ErrEdad) || ($ErrSexo) || ($ErrPeso) || ($ErrNum) || ($ErrFKFinca))) {
                $animal->guardar();
            }
        }

        $router->render('/animal/update', [
            'errores' => $errores,
            'ErrNomb' => $ErrNomb,
            'ErrTipo' => $ErrTipo,
            'ErrRaza' => $ErrRaza,
            'ErrEdad' => $ErrEdad,
            'ErrSexo' => $ErrSexo,
            'ErrPeso' => $ErrPeso,
            'ErrNum' => $ErrNum,
            'ErrFKFinca' => $ErrFKFinca,
            'animal' => $animal
            // ,'resultadodiasl' => $resultadodiasl,
        ]);
    }


    public static function details(Router $router)
    {
        $Id = validarORedireccionar('/animal/index');

        $animal = Animal::find($Id);

        // $resultadodiasl = Dayl::allDias();

        $router->render('/animal/details', [
            'animal' => $animal
            // ,
            // 'resultadodiasl' => $resultadodiasl
        ]);
    }

    public static function delete(Router $router)
    {
        $Id = validarORedireccionar('/animal/index');

        $animal = Animal::find($Id);

        // $resultadodiasl = Dayl::allDias();

        $router->render('/animal/delete', [
            'animal' => $animal
            // ,
            // 'resultadodiasl' => $resultadodiasl
        ]);
    }

    public static function delete_partial(Router $router)
    {
        $Id = $_POST['IdAnimal'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $Id = filter_var($Id, FILTER_VALIDATE_INT);
            if ($Id) {
                $animal = Animal::find($Id);
                $animal->eliminar();
            }
        }

        $router->render('/animal/delete/delete_partial', [
            'animal' => $animal
        ]);
    }


    public static function report_excel(Router $router)
    {
        $animal = Animal::innerJoin();

        $router->render('animal/report_excel', [
            'animal' => $animal
        ]);
    }

    public static function report_pdf(Router $router)
    {
        $opcion = isset($_POST['opcion']) ? $_POST['opcion'] : 'todo';

        $reportPDF = Animal::innerPDF($opcion);

        $router->render('animal/report_pdf', [
            'reportPDF' => $reportPDF
        ]);
    }
}
