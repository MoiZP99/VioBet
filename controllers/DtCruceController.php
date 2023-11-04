<?php

namespace Controllers;

use MVC\Router;
use Model\DtCruce;

class DtCruceController
{
    // public static function index(Router $router)
    // {
    //     $dtCruce = new DtCruce();
    //     // $lugarSolicitud = Animal::innerJoinSolicitud();

    //     $router->render('/dtCruce/index', [
    //         'dtCruce' => $dtCruce
    //     ]);
    // }
    

    public static function index(Router $router)
    {
        $dtCruce = new DtCruce();
        // Obtén los datos del formulario
        $data = $_POST['dtCruce'];
    
        // Realiza el cálculo de los porcentajes aquí
        $razaMadre = $data['RazaMadre'];
        $razaPadre = $data['RazaPadre'];
        $purezaMadre = (float) $data['PurezaMadre'];
        $purezaPadre = (float) $data['PurezaPadre'];

    
        // Lógica de cálculo de los porcentajes resultantes
        $resultado1 = ($razaMadre == 'Puro' || $razaPadre == 'Puro') ? $purezaMadre : ($purezaMadre / 2);
        $resultado2 = min($purezaMadre, $purezaPadre);

    
        // Renderiza la vista con los resultados
        $router->render('/dtCruce/index', [
            'dtCruce' => $dtCruce,
            'resultado1' => $resultado1,
            'resultado2' => $resultado2
        ]);
    }
    

}