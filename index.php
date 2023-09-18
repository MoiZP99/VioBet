<?php 
include_once __DIR__. '/vendor/autoload.php';
include_once __DIR__. '/includes/app.php';

use MVC\Router;
use Controllers\AnimalController;
use Controllers\PagesController;
use Controllers\LoginController;
use Controllers\PrincipalController;

$router = new Router();

//PAGES
$router->get('/principal/index', [PrincipalController::class, 'index']);

//PLACES
$router->get('/animal/index', [AnimalController::class, 'index']);
// $router->post('/animal/index', [AnimalController::class, 'index']);
$router->get('/animal/create', [AnimalController::class, 'create']);
$router->post('/animal/create', [AnimalController::class, 'create']);
$router->get('/animal/update', [AnimalController::class, 'update']);
$router->post('/animal/update', [AnimalController::class, 'update']);
$router->get('/animal/details', [AnimalController::class, 'details']);
$router->get('/animal/delete', [AnimalController::class, 'delete']);
$router->post('/animal/delete/delete_partial', [AnimalController::class, 'delete_partial']);
$router->post('/animal/report_excel', [AnimalController::class, 'report_excel']);
$router->post('/animal/report_pdf', [AnimalController::class, 'report_pdf']);


//PAGES
$router->get('/', [PagesController::class, 'index']);

//LOGIN
$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();