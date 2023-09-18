<?php

namespace MVC;

class Router
{
    public array $getRoutes = [];
    public array $postRoutes = [];

    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function comprobarRutas()
    {
        // session_start();

        // $auth = $_SESSION['login'] ?? null;
        // //Arreglo de rutas protegidas
        // $rutas_protegidas = //principal
        //     [                
        //         '/principal/index',
        //         //places
        //         '/places/index', '/places/create', '/places/update', '/places/details', '/places/delete',
        //         //cate_places
        //         '/cate_places/index', '/cate_places/create', '/cate_places/update', '/cate_places/delete',
        //         //gastronomies
        //         '/gastronomies/index', '/gastronomies/create', '/gastronomies/update', '/gastronomies/delete', '/gastronomies/details',
        //         //cate_gastronomies
        //         '/cate_gastronomies/index', '/cate_gastronomies/create', '/cate_gastronomies/update', '/cate_gastronomies/delete',
        //         //activities
        //         '/activities/index', '/activities/create', '/activities/update', '/activities/delete', '/activities/details',
        //         //entrepeneurs
        //         '/entrepreneurs/index', '/entrepreneurs/create', '/entrepreneurs/update', '/entrepreneurs/delete', '/entrepreneurs/details',
        //         //cate_entrepreneurs
        //         '/cate_entrepreneurs/index', '/cate_entrepreneurs/create', '/cate_entrepreneurs/update', '/cate_entrepreneurs/delete',
        //         //users
        //         '/users/index', '/users/create', '/users/update', '/users/update-pass', '/users/delete'
        //     ];


        $currentUrl = $_SERVER['PATH_INFO'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];

        //Metodo para deploy
        // $currentUrl = $_SERVER['REQUEST_URI'] === '' ? '/': $_SERVER['REQUEST_URI'];
        //$method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'GET') {
            $fn = $this->getRoutes[$currentUrl] ?? null;
        } else {
            $fn = $this->postRoutes[$currentUrl] ?? null;
        }

        //Proteger rutas
        // if (in_array($currentUrl, $rutas_protegidas) && !$auth) {
        //     header('Location: /');
        // }

        if ($fn) {
            // Call user fn va a llamar una función cuando no sabemos cual sera
            call_user_func($fn, $this); // This es para pasar argumentos
        } else {
            echo "Página No Encontrada o Ruta no válida";
        }
    }

    public function renderPages($view, $datos = [])
    {
        // Leer lo que le pasamos  a la vista
        foreach ($datos as $key => $value) {
            $$key = $value;  // Doble signo de dolar significa: variable variable, básicamente nuestra variable sigue siendo la original, pero al asignarla a otra no la reescribe, mantiene su valor, de esta forma el nombre de la variable se asigna dinamicamente
        }

        ob_start(); // Almacenamiento en memoria durante un momento...

        // entonces incluimos la vista en el layout
        include_once __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean(); // Limpia el Buffer
        include_once __DIR__ . '/views/layout.php';
    }

    public function render($view, $datos = [])
    {
        // Leer lo que le pasamos  a la vista
        foreach ($datos as $key => $value) {
            $$key = $value;  // Doble signo de dolar significa: variable variable, 
            //básicamente nuestra variable sigue siendo la original, pero al asignarla a otra no la reescribe, mantiene su valor, de esta forma el nombre de la variable se asigna dinamicamente
        }

        ob_start(); // Almacenamiento en memoria durante un momento...

        // entonces incluimos la vista en el layout
        include_once __DIR__ . "/views/$view.php";
    }
}
