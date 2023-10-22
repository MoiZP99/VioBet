<?php

namespace Controllers;

use MVC\Router;
use Model\Login;
use Model\User;


class LoginController
{
    public static function login(Router $router)
    {
        $errores = [];


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $auth = new Login($_POST);

            $errores = $auth->validar();
            if (empty($errores)) {
                //verificar si el usuario existe
                $resultado = $auth->existeUsuario();
                if (!$resultado) {
                    $errores = Login::getErrores();
                } else {
                    //Verificar la password
                    $autenticado = $auth->comprobarContrasena($resultado);
                    if ($autenticado) {
                        //Autenticar usuario
                        $auth->autenticar();
                    } else {
                        $errores = Login::getErrores();
                    }
                }
            }
        }

        $router->render('login/Login', [
            'errores' => $errores
        ]);
    }
    public static function logout()
    {
        session_start();
        $_SESSION = [];

        header('Location: /');
    }
}
