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

        $data = $_POST['dtCruce'];

        $selectedRazaMadre = isset($data['RazaMadre']) ? $data['RazaMadre'] : '';
        $selectedRazaPadre = isset($data['RazaPadre']) ? $data['RazaPadre'] : '';
        $selectedPurezaMadre = isset($data['PurezaMadre']) ? $data['PurezaMadre'] : '';
        $selectedPurezaPadre = isset($data['PurezaPadre']) ? $data['PurezaPadre'] : '';

        $razaMadre = $data['RazaMadre'];
        $razaPadre = $data['RazaPadre'];
        $purezaMadre = (float) $data['PurezaMadre'];
        $purezaPadre = (float) $data['PurezaPadre'];

        if ($razaMadre == $razaPadre && $purezaMadre == $purezaPadre) {
            $resultado1 = $purezaMadre / 2;
            $resultado2 = $purezaPadre / 2;
        } else {
            $resultado1 = ($razaMadre == 'Puro' || $razaPadre == 'Puro') ? $purezaMadre : ($purezaMadre / 2);
            $resultado2 = min($purezaMadre, $purezaPadre);
        }

        $router->render('/dtCruce/index', [
            'dtCruce' => $dtCruce,
            'resultado1' => $resultado1,
            'resultado2' => $resultado2,
            'selectedRazaMadre' => $selectedRazaMadre,
            'selectedRazaPadre' => $selectedRazaPadre,
            'selectedPurezaMadre' => $selectedPurezaMadre,
            'selectedPurezaPadre' => $selectedPurezaPadre,
        ]);
    }
}
