<?php

use Model\DtCruce;

    // $dtCruce = new DtCruce();

    // Obtén los datos del formulario
    $data = $_POST['dtCruce'];

    // Realiza el cálculo de los porcentajes aquí
    $razaMadre = $data['RazaMadre'];
    $razaPadre = $data['RazaPadre'];
    $purezaMadre = (float) $data['PurezaMadre'];
    $purezaPadre = (float) $data['PurezaPadre'];

    // Lógica de cálculo de los porcentajes resultantes
    if ($razaMadre == $razaPadre && $purezaMadre == $purezaPadre) {
        // Si la raza y el porcentaje son iguales, calcular la mitad para cada uno
        $resultado1 = $purezaMadre / 2;
        $resultado2 = $purezaPadre / 2;
    } else {
        // Si la raza o el porcentaje son diferentes, aplicar lógica original
        $resultado1 = ($razaMadre == 'Puro' || $razaPadre == 'Puro') ? $purezaMadre : ($purezaMadre / 2);
        $resultado2 = min($purezaMadre, $purezaPadre);
    }

    // Renderiza la vista con los resultados
    $router->render('/dtCruce/index', [
        'dtCruce' => $dtCruce,
        'resultado1' => $resultado1,
        'resultado2' => $resultado2
    ]);