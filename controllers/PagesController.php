<?php

namespace Controllers;

use Model\User;
use MVC\Router;
use Model\Animal;

class PagesController
{
    public static function index(Router $router)
    {
        $animal = Animal::get(5);
        // $emprendedores = Entrepreneur::get(5);

        $router->renderPages('/paginas/index', [
            'animal' => $animal
            // ,
            // 'emprendedores' => $emprendedores
        ]);
    }

    public static function register(Router $router)
    {
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

            if (empty(($ErrNomb) || ($ErrApel) || ($ErrApell) || ($ErrContraseña) || ($ErrEmail) || ($ErrTelefono))) {

                $usuario->hashPassword();

                $usuario->guardar();

                if ($usuario) {
                    $_SESSION['success_message'] = ['title' => '¡Éxito! Usuario registrado exitosamente'];
                    header('Location: /register');
                    exit;
                }
            }
        }

        $router->renderPages('/paginas/register', [
            'ErrNomb' => $ErrNomb,
            'ErrApel' => $ErrApel,
            'ErrApell' => $ErrApell,
            'ErrContraseña' => $ErrContraseña,
            'ErrEmail' => $ErrEmail,
            'ErrTelefono' => $ErrTelefono,
            'usuario' => $usuario
        ]);
    }


    public static function contact(Router $router)
    {
        $router->renderPages('/paginas/contact', []);
    }


    public static function gallery(Router $router)
    {
        $router->renderPages('/paginas/gallery', []);
    }
    
        public static function aboutus(Router $router)
    {
        $router->renderPages('/paginas/aboutus', []);
    }

    public static function entrepreneur(Router $router)
    {
        $router->renderPages('/paginas/entrepreneur', []);
    }
}
