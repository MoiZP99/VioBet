<?php

namespace Controllers;

use MVC\Router;
use Model\Product_entrepreneur;

class Product_entrepreneurController
{
    public static function index(Router $router)
    {
        $p_producto = Product_entrepreneur::all();

        // Muestra mensaje condicional
        $resultado = $_GET['r'] ?? null;

        $router->render('/products_entrepreneurs/index', [
            'p_producto' => $p_producto,
            'r' => $resultado
        ]);
    }


    public static function create(Router $router)
    {
        $errores = Product_entrepreneur::getErrores();
        $p_producto = new Product_entrepreneur;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $p_producto = new Product_entrepreneur($_POST['producto_emprendedores']);

            $errores = $p_producto->validar();

            if (empty($errores)) {
                $resultado = $p_producto->guardar();

                if ($resultado) {
                    header('location: /products_entrepreneurs/create');
                }
            }
        }

        $router->render('/products_entrepreneurs/create', [
            'errores' => $errores,
            'p_producto' => $p_producto
        ]);
    }
    
    public static function create_partial(Router $router)
    {
        $errores = Product_entrepreneur::getErrores();
        $p_producto = new Product_entrepreneur;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $p_producto = new Product_entrepreneur($_POST['producto_emprendedores']);

            $errores = $p_producto->validar();

            if (empty($errores)) {
                $resultado = $p_producto->guardar();

                if ($resultado) {
                    header('location: /products_entrepreneurs/create_partial');
                }
            }
        }

        $router->render('/products_entrepreneurs/create_partial', [
            'errores' => $errores,
            'p_producto' => $p_producto
        ]);
    }


    public static function update(Router $router)
    {
        $Id = validarORedireccionar('/products_entrepreneurs/index');

        $p_producto = Product_entrepreneur::find($Id);

        $errores = Product_entrepreneur::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $args = $_POST['producto_emprendedores'];

            $p_producto->sincronizar($args);

            $errores = $p_producto->validar();

            if (empty($errores)) {
                $resultado = $p_producto->guardar();

                if ($resultado) {
                    header('location: /products_entrepreneurs/update');
                }
            }
        }

        $router->render('/products_entrepreneurs/update', [
            'p_producto' => $p_producto,
            'errores' => $errores
        ]);
    }


    public static function eliminar(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $Id = $_POST['Id'];
            $Id = filter_var($Id, FILTER_VALIDATE_INT);
            if ($Id) {
                //Obtener DATOS de Los Lugares desde la base de datos
                $p_producto = Product_entrepreneur::find($Id);
                $resultado = $p_producto->eliminar();

                // Redireccionar
                if ($resultado) {
                    header('location: /products_entrepreneurs/index');
                }
            }
        }
    }
}
