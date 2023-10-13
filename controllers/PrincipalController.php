<?php
namespace Controllers;
use MVC\Router;
use Model\Animal;
use Model\Finca;

class PrincipalController {
    public static function index(Router $router)
    {
        $animal = Animal::innerJoin();
        $finca = Finca::innerJoin();
        // $gastronomias = Gastronomy::innerJoin();
        // $usuarios = User::innerJoin();
        // $actividad = Activity::innerJoin();
        // $emprendedores = Entrepreneur::innerJoin();
        // $emprendeSolicitud = Entrepreneur::innerJoinSolicitud();

        $router->render('/principal/index', [
            'animal' => $animal,
            'finca' => $finca
            // ,
            // 'gastronomias' => $gastronomias,
            // 'usuarios' => $usuarios,
            // 'actividad' => $actividad,
            // 'emprendedores' => $emprendedores,
            // 'emprendeSolicitud' => $emprendeSolicitud
        ]);
    }
}