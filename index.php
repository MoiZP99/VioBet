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
$router->get('/places/index', [AnimalController::class, 'index']);
$router->post('/animal/index', [AnimalController::class, 'index']);
$router->get('/places/create', [AnimalController::class, 'create']);
$router->post('/places/create', [AnimalController::class, 'create']);
$router->get('/places/update', [AnimalController::class, 'update']);
$router->post('/places/update', [AnimalController::class, 'update']);
$router->get('/places/details', [AnimalController::class, 'details']);
$router->get('/places/delete', [AnimalController::class, 'delete']);
$router->post('/places/delete/delete_partial', [AnimalController::class, 'delete_partial']);
$router->post('/places/report_excel', [AnimalController::class, 'report_excel']);
$router->post('/places/report_pdf', [AnimalController::class, 'report_pdf']);


//PAGES
$router->get('/', [PagesController::class, 'index']);

//LOGIN
$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();