<?php 
include_once __DIR__. '/vendor/autoload.php';
include_once __DIR__. '/includes/app.php';

use MVC\Router;
use Controllers\FichaMedicaController;
use Controllers\AnimalController;
use Controllers\DtCruceController;
use Controllers\PagesController;
use Controllers\UserController;
use Controllers\FincaController;
use Controllers\HistorialController;
use Controllers\LoginController;
use Controllers\PrincipalController;

$router = new Router();

//PAGES
$router->get('/principal/index', [PrincipalController::class, 'index']);

//CRUCE
$router->get('/dtCruce/index', [DtCruceController::class, 'index']);
$router->post('/dtCruce/index', [DtCruceController::class, 'index']);

//HISTORIAL MÉDICO
$router->get('/historial/index', [HistorialController::class, 'index']);

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

//FichaMedica
$router->get('/fichamedica/index', [FichaMedicaController::class, 'index']);
$router->get('/fichamedica/create', [FichaMedicaController::class, 'create']);
$router->post('/fichamedica/create', [FichaMedicaController::class, 'create']);
$router->get('/fichamedica/update', [FichaMedicaController::class, 'update']);
$router->post('/fichamedica/update', [FichaMedicaController::class, 'update']);
$router->get('/fichamedica/details', [FichaMedicaController::class, 'details']);
$router->get('/fichamedica/delete', [FichaMedicaController::class, 'delete']);
$router->post('/fichamedica/delete/delete_partial', [FichaMedicaController::class, 'delete_partial']);
$router->post('/fichamedica/report_excel', [FichaMedicaController::class, 'report_excel']);
$router->post('/fichamedica/report_pdf', [FichaMedicaController::class, 'report_pdf']);

//FINCA
$router->get('/finca/index', [FincaController::class, 'index']);
$router->get('/finca/create', [FincaController::class, 'create']);
$router->post('/finca/create', [FincaController::class, 'create']);
$router->get('/finca/update', [FincaController::class, 'update']);
$router->post('/finca/update', [FincaController::class, 'update']);
$router->get('/finca/details', [FincaController::class, 'details']);
$router->get('/finca/delete', [FincaController::class, 'delete']);
$router->post('/finca/delete/delete_partial', [FincaController::class, 'delete_partial']);

//USERS
$router->get('/users/index', [UserController::class, 'index']);
$router->get('/users/create', [UserController::class, 'create']);
$router->post('/users/create', [UserController::class, 'create']);
$router->get('/users/update', [UserController::class, 'update']);
$router->post('/users/update', [UserController::class, 'update']);
$router->get('/users/update-pass', [UserController::class, 'update_pass']);
$router->post('/users/update-pass', [UserController::class, 'update_pass']);
$router->post('/users/delete', [UserController::class, 'delete']);

//PAGES
$router->get('/', [PagesController::class, 'index']);
$router->get('/register', [PagesController::class, 'register']);
$router->post('/register', [PagesController::class, 'register']);

//LOGIN
$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();