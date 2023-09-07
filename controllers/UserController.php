<?php

namespace Controllers;

use Model\Role;
use Model\User;
use MVC\Router;
use Model\StateUser;

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
        $ErrRol = User::getErrRol();
        $ErrContraseña = User::geterrContraseña();
        $ErrEmail = User::getErrEmail();
        $ErrEstado = User::getErrEstado();

        $usuario = new User;
        $resultadorol = Role::all();
        $resultadoestado = StateUser::all();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $usuario = new User($_POST['usuario']);

            $ErrNomb = $usuario->validaNombre();
            $ErrApel = $usuario->validaApel();
            $ErrApell = $usuario->validaApell();
            $ErrRol = $usuario->validaRol();
            $ErrContraseña = $usuario->validaContraseña();
            $ErrEmail = $usuario->validaEmail();
            $ErrEstado = $usuario->validaEstado();

            // $existeUsuario = User::where('email', $usuario->Email);

            if (empty(($ErrNomb) || ($ErrApel) || ($ErrApell) || ($ErrRol) || ($ErrContraseña) || ($ErrEmail) || ($ErrEstado))) {

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
            'ErrRol' => $ErrRol,
            'ErrContraseña' => $ErrContraseña,
            'ErrEmail' => $ErrEmail,
            'ErrEstado' => $ErrEstado,
            'usuario' => $usuario,
            'resultadorol' => $resultadorol,
            'resultadoestado' => $resultadoestado
        ]);
    }


    public static function update(Router $router)
    {
        $Id = validarORedireccionar('/users/index');

        $usuario = User::find($Id);
        $resultadorol = Role::all();
        $resultadoestado = StateUser::all();

        $ErrNomb = User::getErrNomb();
        $ErrApel = User::getErrApel();
        $ErrApell = User::getErrApell();
        $ErrRol = User::getErrRol();
        $ErrEmail = User::getErrEmail();
        $ErrEstado = User::getErrEstado();
        $ErrMotivo = User::getErrMotivo();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $args = $_POST['usuario'];

            $usuario->sincronizar($args);

            $ErrNomb = $usuario->validaNombre();
            $ErrApel = $usuario->validaApel();
            $ErrApell = $usuario->validaApell();
            $ErrRol = $usuario->validaRol();
            $ErrEmail = $usuario->validaEmail();
            $ErrEstado = $usuario->validaEstado();
            $ErrMotivo = $usuario->validaMotivo();

            if (empty(($ErrNomb) || ($ErrApel) || ($ErrApell) || ($ErrRol) || ($ErrEmail) || ($ErrEstado) || ($ErrMotivo))) {

                $usuario->guardar();
            }
        }

        $router->render('/users/update', [
            'usuario' => $usuario,
            'resultadorol' => $resultadorol,
            'resultadoestado' => $resultadoestado,
            'ErrNomb' => $ErrNomb,
            'ErrApel' => $ErrApel,
            'ErrApell' => $ErrApell,
            'ErrRol' => $ErrRol,
            'ErrEmail' => $ErrEmail,
            'ErrEstado' => $ErrEstado,
            'ErrMotivo' => $ErrMotivo,
        ]);
    }


    public static function update_pass(Router $router)
    {
        $Id = validarORedireccionar('/users/index');

        $usuario = User::find($Id);

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
}
