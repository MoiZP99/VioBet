<?php

namespace Controllers;

use MVC\Router;
use Model\FichaMedica;
use Model\Historial;

class HistorialController
{
    public static function index(Router $router)
    {
        // $historial = Historial::innerJoin();
        $historial = Historial::get();

        $router->render('/historial/index', [
            'historial' => $historial
        ]);
    }

    public static function report_excel(Router $router)
    {
        $historial = FichaMedica::innerJoin();

        $router->render('fichamedica/report_excel', [
            'fichamedica' => $historial
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
