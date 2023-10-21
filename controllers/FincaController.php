<?php

namespace Controllers;

use MVC\Router;
use Model\Finca;
use Model\User;

class FincaController
{
    public static function index(Router $router)
    {
        $finca = Finca::innerJoin();
        // $lugarSolicitud = Animal::innerJoinSolicitud();

        $router->render('/finca/index', [
            'finca' => $finca
            // ,
            // 'lugarSolicitud' => $lugarSolicitud
        ]);
    }

    public static function create(Router $router)
    {
        session_start();

        $finca = new Finca();
        $usuario = User::all();
        $errores = Finca::getErrores();
        $ErrNomb = Finca::getErrNomb();
        $ErrUbi = Finca::getErrUbi();
        $ErrTama = Finca::getErrTama();
        $ErrFKFinca = Finca::getErrFKUsuario();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $finca = new Finca($_POST['finca']);

            $errores = $finca->validar();
            $ErrNomb = $finca->validaNombre();
            $ErrUbi = $finca->validaUbi();
            $ErrTama = $finca->validaTama();
            $ErrFKFinca = $finca->validaFKUsuario();

            if (empty(($ErrNomb) || ($ErrUbi) || ($ErrTama) || ($ErrFKFinca) || ($errores))) {
                $finca->guardar();
                if ($finca) {
                    $_SESSION['success_message'] = ['title' => '¡Éxito! Datos de la finca guardados exitosamente'];
                    header('Location: /finca/create');
                    exit;
                }
            }
        }

        $router->render('/finca/create', [
            'errores' => $errores,
            'ErrNomb' => $ErrNomb,
            'ErrUbi' => $ErrUbi,
            'ErrTama' => $ErrTama,
            'ErrFKFinca' => $ErrFKFinca,
            'finca' => $finca,
            'usuario' => $usuario,
        ]);
    }


    public static function update(Router $router)
    {
        $IdFinca = validarORedireccionarFinca('/finca/index');

        $finca = Finca::find($IdFinca);
        $usuario = User::all();

        $errores = Finca::getErrores();
        $ErrNomb = Finca::getErrNomb();
        $ErrUbi = Finca::getErrUbi();
        $ErrTama = Finca::getErrTama();
        $ErrFKFinca = Finca::getErrFKUsuario();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $args = $_POST['finca'];

            $finca->sincronizar($args);

            $errores = $finca->validar();
            $ErrNomb = $finca->validaNombre();
            $ErrUbi = $finca->validaUbi();
            $ErrTama = $finca->validaTama();
            $ErrFKFinca = $finca->validaFKUsuario();

            if (empty(($ErrNomb) || ($ErrUbi) || ($ErrTama) || ($ErrFKFinca) || ($errores))) {
                $finca->guardar();
            }
        }

        $router->render('/finca/update', [
            'errores' => $errores,
            'ErrNomb' => $ErrNomb,
            'ErrUbi' => $ErrUbi,
            'ErrTama' => $ErrTama,
            'ErrFKFinca' => $ErrFKFinca,
            'finca' => $finca,
            'usuario' => $usuario
        ]);
    }


    public static function details(Router $router)
    {
        $IdFinca = validarORedireccionarFinca('/finca/index');

        $finca = Finca::find($IdFinca);
        $usuario = User::all();

        $router->render('/finca/details', [
            'finca' => $finca,
            'usuario' => $usuario
        ]);
    }

    public static function delete(Router $router)
    {
        $IdFinca = validarORedireccionarFinca('/finca/index');

        $finca = Finca::find($IdFinca);
        $usuario = User::all();

        $router->render('/finca/delete', [
            'finca' => $finca,
            'usuario' => $usuario
        ]);
    }

    public static function delete_partial(Router $router)
    {
        $IdFinca = $_POST['IdFinca'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $IdFinca = filter_var($IdFinca, FILTER_VALIDATE_INT);
            if ($IdFinca) {
                $finca = Finca::find($IdFinca);
                $finca->eliminar();
            }
        }

        $router->render('/finca/delete/delete_partial', [
            'finca' => $finca
        ]);
    }
}