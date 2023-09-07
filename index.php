<?php 
include_once __DIR__. '/vendor/autoload.php';
include_once __DIR__. '/includes/app.php';

use MVC\Router;
use Controllers\Cate_GastronomyController;
use Controllers\EntrepreneurController;
use Controllers\PlaceController;
use Controllers\Cate_PlaceController;
use Controllers\GastronomyController;
use Controllers\UserController;
use Controllers\ActivityController;
use Controllers\PagesController;
use Controllers\Cate_EntrepreneurController;
use Controllers\LoginController;
use Controllers\PrincipalController;

$router = new Router();

//PAGES
$router->get('/principal/index', [PrincipalController::class, 'index']);

//PLACES
$router->get('/places/index', [PlaceController::class, 'index']);
$router->post('/places/index', [PlaceController::class, 'index']);
$router->get('/places/create', [PlaceController::class, 'create']);
$router->post('/places/create', [PlaceController::class, 'create']);
$router->get('/places/update', [PlaceController::class, 'update']);
$router->post('/places/update', [PlaceController::class, 'update']);
$router->get('/places/details', [PlaceController::class, 'details']);
$router->get('/places/delete', [PlaceController::class, 'delete']);
$router->post('/places/delete/delete_partial', [PlaceController::class, 'delete_partial']);
$router->post('/places/report_excel', [PlaceController::class, 'report_excel']);
$router->post('/places/report_pdf', [PlaceController::class, 'report_pdf']);

//CETE_PLACES
$router->get('/cate_places/index', [Cate_PlaceController::class, 'index']);
$router->get('/cate_places/create', [Cate_PlaceController::class, 'create']);
$router->post('/cate_places/create', [Cate_PlaceController::class, 'create']);
$router->get('/cate_places/update', [Cate_PlaceController::class, 'update']);
$router->post('/cate_places/update', [Cate_PlaceController::class, 'update']);
$router->post('/cate_places/delete', [Cate_PlaceController::class, 'delete']);

//GASTRONOMIES
$router->get('/gastronomies/index', [GastronomyController::class, 'index']);
$router->get('/gastronomies/create', [GastronomyController::class, 'create']);
$router->post('/gastronomies/create', [GastronomyController::class, 'create']);
$router->get('/gastronomies/update', [GastronomyController::class, 'update']);
$router->post('/gastronomies/update', [GastronomyController::class, 'update']);
$router->get('/gastronomies/details', [GastronomyController::class, 'details']);
$router->get('/gastronomies/delete', [GastronomyController::class, 'delete']);
$router->post('/gastronomies/delete/delete_partial', [GastronomyController::class, 'delete_partial']);
$router->post('/gastronomies/report_excel', [GastronomyController::class, 'report_excel']);
$router->post('/gastronomies/report_pdf', [GastronomyController::class, 'report_pdf']);

//CATE_GASTRONOMIES
$router->get('/cate_gastronomies/index', [Cate_GastronomyController::class, 'index']);
$router->get('/cate_gastronomies/create', [Cate_GastronomyController::class, 'create']);
$router->post('/cate_gastronomies/create', [Cate_GastronomyController::class, 'create']);
$router->get('/cate_gastronomies/update', [Cate_GastronomyController::class, 'update']);
$router->post('/cate_gastronomies/update', [Cate_GastronomyController::class, 'update']);
$router->post('/cate_gastronomies/delete', [Cate_GastronomyController::class, 'delete']);

//ACTIVITIES
$router->get('/activities/index', [ActivityController::class, 'index']);
$router->get('/activities/create', [ActivityController::class, 'create']);
$router->post('/activities/create', [ActivityController::class, 'create']);
$router->get('/activities/update', [ActivityController::class, 'update']);
$router->post('/activities/update', [ActivityController::class, 'update']);
$router->get('/activities/details', [ActivityController::class, 'details']);
$router->get('/activities/delete', [ActivityController::class, 'delete']);
$router->post('/activities/delete/delete_partial', [ActivityController::class, 'delete_partial']);
$router->post('/activities/report_excel', [ActivityController::class, 'report_excel']);
$router->post('/activities/report_pdf', [ActivityController::class, 'report_pdf']);

//ENTREPRENEURS
$router->get('/entrepreneurs/index', [EntrepreneurController::class, 'index']);
$router->get('/entrepreneurs/create', [EntrepreneurController::class, 'create']);
$router->post('/entrepreneurs/create', [EntrepreneurController::class, 'create']);
$router->get('/entrepreneurs/update', [EntrepreneurController::class, 'update']);
$router->post('/entrepreneurs/update', [EntrepreneurController::class, 'update']);
$router->get('/entrepreneurs/details', [EntrepreneurController::class, 'details']);
$router->get('/entrepreneurs/delete', [EntrepreneurController::class, 'delete']);
$router->post('/entrepreneurs/delete/delete_partial', [EntrepreneurController::class, 'delete_partial']);
$router->post('/entrepreneurs/report_excel', [EntrepreneurController::class, 'report_excel']);
$router->post('/entrepreneurs/report_pdf', [EntrepreneurController::class, 'report_pdf']);

//CATE_ENTREPRENEURS
$router->get('/cate_entrepreneurs/index', [Cate_EntrepreneurController::class, 'index']);
$router->get('/cate_entrepreneurs/create', [Cate_EntrepreneurController::class, 'create']);
$router->post('/cate_entrepreneurs/create', [Cate_EntrepreneurController::class, 'create']);
$router->get('/cate_entrepreneurs/update', [Cate_EntrepreneurController::class, 'update']);
$router->post('/cate_entrepreneurs/update', [Cate_EntrepreneurController::class, 'update']);
$router->get('/cate_entrepreneurs/delete', [Cate_EntrepreneurController::class, 'delete']);
$router->post('/cate_entrepreneurs/delete', [Cate_EntrepreneurController::class, 'delete']);

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
$router->get('/place-details', [PagesController::class, 'place_details']);
$router->get('/entrepreneur-details', [PagesController::class, 'entrepreneur_details']);
$router->get('/gastronomy-details', [PagesController::class, 'gastronomy_details']);
$router->get('/entrepreneur', [PagesController::class, 'carrusel_entre']);
$router->get('/gallery', [PagesController::class, 'gallery']);
$router->get('/aboutus', [PagesController::class, 'aboutus']);
$router->get('/commerce', [PagesController::class, 'commerceAllCarousel']);
$router->get('/contact', [PagesController::class, 'contact']);
$router->get('/entrepreneur-form', [PagesController::class, 'create_partial_entrepreneur']);
$router->post('/entrepreneur-form', [PagesController::class, 'create_partial_entrepreneur']);
$router->get('/tourist-places_form', [PagesController::class, 'create_partial_place']);
$router->post('/tourist-places_form', [PagesController::class, 'create_partial_place']);
$router->get('/activity-details', [PagesController::class, 'activity_details']);
$router->get('/places', [PagesController::class, 'place_all']);
$router->get('/place-all-details', [PagesController::class, 'place_all_details']);
$router->get('/entrepreneurs', [PagesController::class, 'entrepreneur_all']);
$router->get('/entrepreneur-all-details', [PagesController::class, 'entrepreneur_all_details']);
$router->get('/gastronomies', [PagesController::class, 'gastronomy_all']);
$router->get('/gastronomy-all-details', [PagesController::class, 'gastronomy_all_details']);
$router->get('/activities', [PagesController::class, 'activity_all']);
$router->get('/activity-all-details', [PagesController::class, 'activity_all_details']);

//LOGIN
$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();