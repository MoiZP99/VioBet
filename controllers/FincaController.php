<?php

namespace Controllers;

use MVC\Router;
use Model\Finca;

class AnimalController
{
    public static function index(Router $router)
    {
        $finca = Finca::innerJoin();
        // $lugarSolicitud = Animal::innerJoinSolicitud();

        $router->render('/finca/index', [
            'finca' => $finca
            // ,
            // 'lugarSolicitud' => $lugarSolicitud
        ]);
    }

    public static function create(Router $router)
    {
        session_start();

        $finca = new Finca();
        // $resultadoestado = Pasture::all();
        $errores = Finca::getErrores();
        $ErrNomb = Finca::getErrNomb();
        $ErrTipo = Finca::getErrUbi();
        $ErrRaza = Finca::getErrTama();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $finca = new Finca($_POST['finca']);

            $errores = $finca->validar();
            $ErrNomb = $finca->validaNombre();
            $ErrUbi = $finca->validaUbi();
            $ErrTama = $finca->validaTama();
           // $ErrFKFinca = $finca->validaFinca();

            if (empty(($ErrNomb) || ($ErrUbi) || ($ErrTama))) {
                $finca->guardar();
                if ($finca) {
                    $_SESSION['success_message'] = ['title' => '¡Éxito! Datos de la finca guardados exitosamente'];
                    header('Location: /finca/create');
                    exit;
                }
            }
        }

        $router->render('/finca/create', [
            'errores' => $errores,
            'ErrNomb' => $ErrNomb,
            'ErrUbi' => $ErrUbi,
            'ErrTama' => $ErrTama,
            'finca' => $finca
            // ,'resultadodiasl' => $resultadodiasl,
        ]);
    }


    public static function update(Router $router)
    {
        $Id = validarORedireccionar('/finca/index');

        $finca = Finca::find($Id);


        // $resultadodiasl = Dayl::allDias();

        $errores = Finca::getErrores();
        $ErrNomb = Finca::getErrNomb();
        $ErrUbi = Finca::getErrUbi();
        $ErrTama = Finca::getErrTama();
        //$ErrFKFinca = Animal::getErrFKFinca();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $args = $_POST['finca'];

            $finca->sincronizar($args);

            $errores = $finca->validar();
            $ErrNomb = $finca->validaNombre();
            $ErrUbi = $finca->validaUbi();
            $ErrTama = $finca->validaTama();
           // $ErrFKFinca = $animal->validaFinca();

            if (empty(($ErrNomb) || ($ErrUbi) || ($ErrTama))) {
                $finca->guardar();
            }
        }

        $router->render('/finca/update', [
            'errores' => $errores,
            'ErrNomb' => $ErrNomb,
            'ErrUbi' => $ErrUbi,
            'ErrTama' => $ErrTama,
            'finca' => $finca
            // ,'resultadodiasl' => $resultadodiasl,
        ]);
    }


    public static function details(Router $router)
    {
        $Id = validarORedireccionar('/finca/index');

        $finca = Finca::find($Id);

        // $resultadodiasl = Dayl::allDias();

        $router->render('/finca/details', [
            'finca' => $finca
            // ,
            // 'resultadodiasl' => $resultadodiasl
        ]);
    }

    public static function delete(Router $router)
    {
        $Id = validarORedireccionar('/finca/index');

        $finca = Finca::find($Id);

        // $resultadodiasl = Dayl::allDias();

        $router->render('/finca/delete', [
            'finca' => $finca
            // ,
            // 'resultadodiasl' => $resultadodiasl
        ]);
    }

    public static function delete_partial(Router $router)
    {
        $Id = $_POST['IdFinca'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $Id = filter_var($Id, FILTER_VALIDATE_INT);
            if ($Id) {
                $finca = Finca::find($Id);
                $finca->eliminar();
            }
        }

        $router->render('/finca/delete/delete_partial', [
            'finca' => $finca
        ]);
    }


    public static function report_excel(Router $router)
    {
        $finca = Finca::innerJoin();

        $router->render('finca/report_excel', [
            'finca' => $finca
        ]);
    }

    public static function report_pdf(Router $router)
    {
        $opcion = isset($_POST['opcion']) ? $_POST['opcion'] : 'todo';

        $reportPDF = Finca::innerPDF($opcion);

        $router->render('finca/report_pdf', [
            'reportPDF' => $reportPDF
        ]);
    }
}