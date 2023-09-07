<?php

namespace Controllers;

use MVC\Router;
use Model\Cate_Gastronomy;

class Cate_GastronomyController
{
    public static function index(Router $router)
    {
        $categorias = Cate_Gastronomy::allCategoriaGastronomia();

        $router->render('/cate_gastronomies/index', [
            'categorias' => $categorias
        ]);
    }


    public static function create(Router $router)
    {
        session_start();

        $errores = Cate_Gastronomy::getErrores();
        $categoria = new Cate_Gastronomy;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $categoria = new Cate_Gastronomy($_POST['categoria_gastronomia']);

            $errores = $categoria->validar();

            if (empty($errores)) {
                
                $categoria->guardar();
                
                if ($categoria) {
                    $_SESSION['success_message'] = ['title' => '¡Éxito! Categoría guardada exitosamente'];
                    header('Location: /cate_gastronomies/create');
                    exit;
                }
            }
        }

        $router->render('/cate_gastronomies/create', [
            'errores' => $errores,
            'categoria' => $categoria
        ]);
    }


    public static function update(Router $router)
    {
        $Id = validarORedireccionar('/cate_gastronomies/index');

        $categoria = Cate_Gastronomy::find($Id);

        $errores = Cate_Gastronomy::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $args = $_POST['categoria_gastronomia'];

            $categoria->sincronizar($args);

            $errores = $categoria->validar();

            if (empty($errores)) {
                $categoria->guardar();

                // if ($resultado) {
                //     header('location: /cate_gastronomies/index');
                // }
            }
        }

        $router->render('/cate_gastronomies/update', [
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
                $categoria = Cate_Gastronomy::find($Id);
                $categoria->eliminar();
            }
        }

        $router->render('/cate_gastronomies/delete', [
            'categoria' => $categoria
        ]);
    }
}
