<?php

namespace Controllers;

use MVC\Router;
use Model\Cate_Place;

class Cate_PlaceController
{
    public static function index(Router $router)
    {
        $categorias = Cate_Place::allCategoriaLugar();

        $router->render('/cate_places/index', [
            'categorias' => $categorias
        ]);
    }


    public static function create(Router $router)
    {
        session_start();

        $errores = Cate_Place::getErrores();

        $categoria = new Cate_Place();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $categoria = new Cate_Place($_POST['categoria_lugar']);

            $errores = $categoria->validar();

            if (empty($errores)) {
                $categoria->guardar();
                if ($categoria) {
                    $_SESSION['success_message'] = ['title' => '¡Éxito! Categoría guardada exitosamente'];
                    header('Location: /cate_places/create');
                    exit;
                }
            }
        }

        $router->render('/cate_places/create', [
            'errores' => $errores,
            'categoria' => $categoria
        ]);
    }



    public static function update(Router $router)
    {
        $Id = validarORedireccionar('/cate_places/index');

        $categoria = Cate_Place::find($Id);

        $errores = Cate_Place::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $args = $_POST['categoria_lugar'];

            $categoria->sincronizar($args);

            $errores = $categoria->validar();

            if (empty($errores)) {
                $categoria->guardar();
            }
        }

        $router->render('/cate_places/update', [
            'categoria' => $categoria,
            'errores' => $errores
        ]);
    }


    public static function delete(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $Id = $_POST['Id'];

            $Id = filter_var($Id, FILTER_VALIDATE_INT);
            if ($Id) {
                $categoria = Cate_Place::find($Id);
                $categoria->eliminar();
            }
        }

        $router->render('/cate_places/delete', [
            'categoria' => $categoria
        ]);
    }
}
