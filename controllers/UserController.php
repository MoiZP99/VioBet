<?php

namespace Controllers;

use Model\User;
use MVC\Router;

class UserController
{
    public static function index(Router $router)
    {
        $usuarios = User::innerJoin();

        $router->render('/users/index', [
            'usuarios' => $usuarios
        ]);
    }


    public static function create(Router $router)
    {
        session_start();

        $ErrNomb = User::getErrNomb();
        $ErrApel = User::getErrApel();
        $ErrApell = User::getErrApell();
        $ErrContraseña = User::geterrContraseña();
        $ErrEmail = User::getErrEmail();
        $ErrTelefono = User::getErrTel();

        $usuario = new User;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $usuario = new User($_POST['usuario']);

            $ErrNomb = $usuario->validaNombre();
            $ErrApel = $usuario->validaApel();
            $ErrApell = $usuario->validaApell();
            $ErrContraseña = $usuario->validaContraseña();
            $ErrEmail = $usuario->validaEmail();
            $ErrTelefono = $usuario->validaTelefono();

            // debuguear($usuario);

            // $existeUsuario = User::where('email', $usuario->Email);

            if (empty(($ErrNomb) || ($ErrApel) || ($ErrApell) || ($ErrContraseña) || ($ErrEmail) || ($ErrTelefono))) {

                $usuario->hashPassword();
                
                $usuario->guardar();

                if ($usuario) {
                    $_SESSION['success_message'] = ['title' => '¡Éxito! Usuario guardado exitosamente'];
                    header('Location: /users/create');
                    exit;
                }
            }
        }

        $router->render('/users/create', [
            'ErrNomb' => $ErrNomb,
            'ErrApel' => $ErrApel,
            'ErrApell' => $ErrApell,
            'ErrContraseña' => $ErrContraseña,
            'ErrEmail' => $ErrEmail,
            'ErrTelefono' => $ErrTelefono,
            'usuario' => $usuario
        ]);
    }


    public static function update(Router $router)
    {
        $IdUsuario = validarORedireccionarUser('/users/index');

        $usuario = User::find($IdUsuario);

        $ErrNomb = User::getErrNomb();
        $ErrApel = User::getErrApel();
        $ErrApell = User::getErrApell();
        $ErrEmail = User::getErrEmail();
        $ErrTelefono = User::getErrTel();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $args = $_POST['usuario'];

            $usuario->sincronizar($args);

            $ErrNomb = $usuario->validaNombre();
            $ErrApel = $usuario->validaApel();
            $ErrApell = $usuario->validaApell();
            $ErrEmail = $usuario->validaEmailUpdate();
            $ErrTelefono = $usuario->validaTelefono();

            if (empty(($ErrNomb) || ($ErrApel) || ($ErrApell) || ($ErrEmail) || ($ErrTelefono))) {

                $usuario->guardar();
            }
        }

        $router->render('/users/update', [
            'usuario' => $usuario,
            'ErrNomb' => $ErrNomb,
            'ErrApel' => $ErrApel,
            'ErrApell' => $ErrApell,
            'ErrEmail' => $ErrEmail,
            'ErrTelefono' => $ErrTelefono,
            
        ]);
    }


    public static function update_pass(Router $router)
    {
        $IdUsuario = validarORedireccionarUser('/users/index');

        $usuario = User::find($IdUsuario);

        $ErrContraseña = User::getErrContraseña();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $args = $_POST['usuario'];

            $usuario->sincronizar($args);

            $ErrContraseña = $usuario->validaContraseña();

            if (empty(($ErrContraseña))) {

                $usuario->hashPassword();
                $usuario->guardar();
            }
        }

        $router->render('/users/update-pass', [
            'usuario' => $usuario,
            'ErrContraseña' => $ErrContraseña
        ]);
    }
    public static function update_sub(Router $router)
    {
        $IdUsuario = validarORedireccionarUser('/users/index');

        $usuario = User::find($IdUsuario);

        $ErrSuscripcion = User::getErrSuscripcion();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $args = $_POST['usuario'];

            $usuario->sincronizar($args);

            $ErrSuscripcion = $usuario->validaSuscripcion();

            if (empty(($ErrSuscripcion))) {

                
                $usuario->guardar();
            }
            

            

                
                $usuario->guardar();
            
        }

        $router->render('/users/update-sub', [
            'usuario' => $usuario,
            'ErrSuscripcion' => $ErrSuscripcion
        ]);
    }


    public static function eliminar(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $Id = $_POST['Id'];
            $Id = filter_var($Id, FILTER_VALIDATE_INT);
            if ($Id) {
                $usuario = User::find($Id);
                $resultado = $usuario->eliminar();

                if ($resultado) {
                    header('location: /users/index');
                }
            }
        }
    }


    //Metodo pagos
    public static function indexpay(Router $router)
    {
        $usuarios = User::innerJoin();

        $router->render('/payment/payment', [
            'usuarios' => $usuarios
        ]);
    }

    

}



