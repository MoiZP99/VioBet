<?php
namespace Controllers;
use MVC\Router;
use Model\User;
use Model\Place;
use Model\Activity;
use Model\Gastronomy;
use Model\Entrepreneur;

class PrincipalController {
    public static function index(Router $router)
    {
        $lugares = Place::innerJoin();
        $lugarSolicitud = Place::innerJoinSolicitud();
        $gastronomias = Gastronomy::innerJoin();
        $usuarios = User::innerJoin();
        $actividad = Activity::innerJoin();
        $emprendedores = Entrepreneur::innerJoin();
        $emprendeSolicitud = Entrepreneur::innerJoinSolicitud();

        $router->render('/principal/index', [
            'lugares' => $lugares,
            'lugarSolicitud' => $lugarSolicitud,
            'gastronomias' => $gastronomias,
            'usuarios' => $usuarios,
            'actividad' => $actividad,
            'emprendedores' => $emprendedores,
            'emprendeSolicitud' => $emprendeSolicitud
        ]);
    }
}