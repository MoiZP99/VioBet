<?php

namespace Controllers;

use MVC\Router;
use Model\Cate_Entrepreneur;

class Cate_EntrepreneurController
{
    public static function index(Router $router)
    {
        $categorias = Cate_Entrepreneur::all();

        $router->render('/cate_entrepreneurs/index', [
            'categorias' => $categorias
        ]);
    }


    public static function create(Router $router)
    {
        session_start();

        $errores = Cate_Entrepreneur::getErrores();
        $categoria = new Cate_Entrepreneur;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $categoria = new Cate_Entrepreneur($_POST['tipoactividad_emprendedor']);

            $errores = $categoria->validar();

            if (empty($errores)) {
                $categoria->guardar();
                if ($categoria) {
                    $_SESSION['success_message'] = ['title' => '¡Éxito! Categoría guardada exitosamente'];
                    header('Location: /cate_entrepreneurs/create');
                    exit;
                }
            }
        }

        $router->render('/cate_entrepreneurs/create', [
            'errores' => $errores,
            'categoria' => $categoria
        ]);
    }


    public static function update(Router $router)
    {
        $Id = validarORedireccionar('/cate_entrepreneurs/index');

        $categoria = Cate_Entrepreneur::find($Id);

        $errores = Cate_Entrepreneur::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $args = $_POST['tipoactividad_emprendedor'];

            $categoria->sincronizar($args);

            $errores = $categoria->validar();

            if (empty($errores)) {
                $resultado = $categoria->guardar();

                if ($resultado) {
                    header('location: /cate_entrepreneurs/index');
                }
            }
        }

        $router->render('/cate_entrepreneurs/update', [
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
                $categoria = Cate_Entrepreneur::find($Id);
                $categoria->eliminar();
            }
        }

        $router->render('/cate_entrepreneurs/delete', [
            'categoria' => $categoria
        ]);
    }
}
