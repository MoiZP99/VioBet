<?php

namespace Controllers;

use MVC\Router;
use Model\Animal;
use Model\Finca;

class AnimalController
{
    public static function index(Router $router)
    {
        $animal = Animal::innerJoin();
        // $lugarSolicitud = Animal::innerJoinSolicitud();

        $router->render('/animal/index', [
            'animal' => $animal
            ,
            // 'lugarSolicitud' => $lugarSolicitud
        ]);
    }

    public static function create(Router $router)
    {
        session_start();

        $animal = new Animal();
        $finca = Finca::all();
        $errores = Animal::getErrores();
        $ErrNomb = Animal::getErrNomb();
        $ErrTipo = Animal::getErrTipo();
        $ErrSangr = Animal::getErrSangr();
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
            $ErrSangr = $animal->validaTipoSangre();
            $ErrRaza = $animal->validaRaza();
            $ErrEdad = $animal->validaEdad();
            $ErrSexo = $animal->validaSexo();
            $ErrPeso = $animal->validaPeso();
            $ErrNum = $animal->validaNum();
           
            $ErrFKFinca = $animal->validaFinca();

            if (empty(($errores) || ($ErrNomb) || ($ErrTipo) || ($ErrSangr) || ($ErrRaza) || ($ErrEdad) || ($ErrSexo) || ($ErrPeso) || ($ErrNum) || ($ErrFKFinca))) {
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
            'ErrSangr' => $ErrSangr,
            'ErrRaza' => $ErrRaza,
            'ErrEdad' => $ErrEdad,
            'ErrSexo' => $ErrSexo,
            'ErrPeso' => $ErrPeso,
            'ErrNum' => $ErrNum,
           
            'ErrFKFinca' => $ErrFKFinca,
            'animal' => $animal,
            'finca' => $finca,
        ]);
    }


    public static function update(Router $router)
    {
        $IdAnimal = validarORedireccionarAnimal('/animal/index');

        $animal = Animal::find($IdAnimal);
        $finca = Finca::all();

        $errores = Animal::getErrores();
        $ErrNomb = Animal::getErrNomb();
        $ErrTipo = Animal::getErrTipo();
        $ErrSangr = Animal::getErrSangr();
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
            $ErrSangr = $animal->validaTipoSangre();
            $ErrRaza = $animal->validaRaza();
            $ErrEdad = $animal->validaEdad();
            $ErrSexo = $animal->validaSexo();
            $ErrPeso = $animal->validaPeso();
            $ErrNum = $animal->validaNum();
            $ErrFKFinca = $animal->validaFinca();

            if (empty(($errores) || ($ErrNomb) || ($ErrTipo) ||($ErrSangr) || ($ErrRaza) || ($ErrEdad) || ($ErrSexo) || ($ErrPeso) || ($ErrNum)  || ($ErrFKFinca))) {
                $animal->guardar();
            }
        }

        $router->render('/animal/update', [
            'errores' => $errores,
            'ErrNomb' => $ErrNomb,
            'ErrTipo' => $ErrTipo,
            'ErrSangr' => $ErrSangr,
            'ErrRaza' => $ErrRaza,
            'ErrEdad' => $ErrEdad,
            'ErrSexo' => $ErrSexo,
            'ErrPeso' => $ErrPeso,
            'ErrNum' => $ErrNum,
            'ErrFKFinca' => $ErrFKFinca,
            'animal' => $animal,
            'finca' => $finca
        ]);
    }


    public static function details(Router $router)
    {
        $IdAnimal = validarORedireccionarAnimal('/animal/index');

        $animal = Animal::find($IdAnimal);
        $finca = Finca::all();

        $router->render('/animal/details', [
            'animal' => $animal,
            'finca' => $finca
        ]);
    }

    public static function delete(Router $router)
    {
        $IdAnimal = validarORedireccionarAnimal('/animal/index');

        $animal = Animal::find($IdAnimal);

        // $resultadodiasl = Dayl::allDias();

        $router->render('/animal/delete', [
            'animal' => $animal
            // ,
            // 'resultadodiasl' => $resultadodiasl
        ]);
    }

    public static function delete_partial(Router $router)
    {
        $IdAnimal = $_POST['IdAnimal'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $IdAnimal = filter_var($IdAnimal, FILTER_VALIDATE_INT);
            if ($IdAnimal) {
                $animal = Animal::find($IdAnimal);
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
