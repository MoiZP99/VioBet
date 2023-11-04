<?php
namespace Controllers;
use Model\User;
use MVC\Router;
use Model\Finca;
use Model\Animal;
use Model\FichaMedica;

class PrincipalController {
    public static function index(Router $router)
    {
        $animal = Animal::innerJoin();
        $finca = Finca::innerJoin();
        $usuarios = User::innerJoin();
        $fMedica = FichaMedica::innerJoin();
        // $gastronomias = Gastronomy::innerJoin();
        // $actividad = Activity::innerJoin();
        // $emprendedores = Entrepreneur::innerJoin();
        // $emprendeSolicitud = Entrepreneur::innerJoinSolicitud();

        $router->render('/principal/index', [
            'animal' => $animal,
            'finca' => $finca,
            'usuarios' => $usuarios,
            'fMedica' => $fMedica
            // ,
            // 'gastronomias' => $gastronomias,
            
            // 'actividad' => $actividad,
            // 'emprendedores' => $emprendedores,
            // 'emprendeSolicitud' => $emprendeSolicitud
        ]);
    }
}