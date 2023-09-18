<?php

namespace Controllers;

use Model\Age;
use Model\Dayl;
use MVC\Router;
use Model\Dayll;
use Model\Place;
use Model\Space;
use Model\State;
use Model\Activity;
use Model\Cate_Place;
use Model\Gastronomy;
use Model\StatePlace;
use Model\DayActivity;
use Model\Entrepreneur;
use Model\Cate_Gastronomy;
use Model\Cate_Entrepreneur;
use Model\Fair_Entrepreneur;
use Intervention\Image\ImageManagerStatic as Image;
use Model\Animal;

class PagesController
{
    public static function index(Router $router)
    {
        $animal = Animal::get(5);
        // $emprendedores = Entrepreneur::get(5);

        $router->renderPages('/paginas/index', [
            'animal' => $animal,
            'emprendedores' => $emprendedores
        ]);
    }


    public static function gastronomy_details(Router $router)
    {
        $Id = validarORedireccionar('/paginas/commerce');
        $gastronomia = Gastronomy::find($Id);
        $resultadodiasl = Dayl::allDias();
        $resultadodiasll = Dayll::allDias();
        $resultadocategoria = Cate_Gastronomy::allCategoriaGastronomia();

        $router->renderPages('/paginas/gastronomy-details', [
            'gastronomia' => $gastronomia,
            'resultadodiasl' => $resultadodiasl,
            'resultadodiasll' => $resultadodiasll,
            'resultadocategoria' => $resultadocategoria
        ]);
    }
    
    public static function gastronomy_all_details(Router $router)
    {
        $Id = validarORedireccionar('/paginas/commerce');
        $gastronomia = Gastronomy::find($Id);
        $resultadodiasl = Dayl::allDias();
        $resultadodiasll = Dayll::allDias();
        $resultadocategoria = Cate_Gastronomy::allCategoriaGastronomia();

        $router->renderPages('/paginas/gastronomy-all-details', [
            'gastronomia' => $gastronomia,
            'resultadodiasl' => $resultadodiasl,
            'resultadodiasll' => $resultadodiasll,
            'resultadocategoria' => $resultadocategoria
        ]);
    }

    public static function commerceAllCarousel(Router $router)
    {
        $gastronomia = Gastronomy::get(5);
        $actividad = Activity::get(5);

        $router->renderPages('/paginas/commerce', [
            'gastronomia' => $gastronomia,
            'actividad' => $actividad
        ]);
    }

    public static function gastronomy_all(Router $router)
    {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $limit = 12;

        $modelo = new Gastronomy();
        $totalRecords = $modelo->obtenerTotalRegistros();

        $totalPages = ceil($totalRecords / $limit);

        if ($page < 1) {
            $page = 1;
        } elseif ($page > $totalPages) {
            $page = $totalPages;
        }

        $offset = ($page - 1) * $limit;

        $datos = $modelo->obtenerRegistrosPaginados($limit, $offset);

        $paginacion = $modelo->generarPaginacion($page, $totalPages);

        $router->renderPages('/paginas/gastronomies', [
            'datos' => $datos,
            'paginacion' => $paginacion
        ]);
    }
    
    public static function activity_all(Router $router)
    {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $limit = 12;

        $modelo = new Activity();
        $totalRecords = $modelo->obtenerTotalRegistros();

        $totalPages = ceil($totalRecords / $limit);

        if ($page < 1) {
            $page = 1;
        } elseif ($page > $totalPages) {
            $page = $totalPages;
        }

        $offset = ($page - 1) * $limit;

        $datos = $modelo->obtenerRegistrosPaginados($limit, $offset);

        $paginacion = $modelo->generarPaginacion($page, $totalPages);

        $router->renderPages('/paginas/activities', [
            'datos' => $datos,
            'paginacion' => $paginacion
        ]);
    }

    public static function carrusel_entre(Router $router)
    {

        $emprendedores = Entrepreneur::innerJoin();
        $router->renderPages('/paginas/entrepreneur', [
            'emprendedores' => $emprendedores
        ]);
    }

    public static function activity_details(Router $router)
    {
        $Id = validarORedireccionar('/paginas/commerce');
        $actividad = Activity::find($Id);

        $resultadoedad = Age::all();
        $resultadodias = DayActivity::allDias();

        $router->renderPages('/paginas/activity-details', [
            'actividad' => $actividad,
            'resultadoedad' => $resultadoedad,
            'resultadodias' => $resultadodias
        ]);
    }
    
    public static function activity_all_details(Router $router)
    {
        $Id = validarORedireccionar('/paginas/commerce');
        $actividad = Activity::find($Id);

        $resultadoedad = Age::all();
        $resultadodias = DayActivity::allDias();

        $router->renderPages('/paginas/activity-all-details', [
            'actividad' => $actividad,
            'resultadoedad' => $resultadoedad,
            'resultadodias' => $resultadodias
        ]);
    }

    public static function place_all(Router $router)
    {
        // Se obtiene el número de página actual y el número total de páginas por medio de los parámetros de la URL
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $limit = 12; // Cantidad de registros por página

        $modelo = new Place();
        $totalRecords = $modelo->obtenerTotalRegistros();

        $totalPages = ceil($totalRecords / $limit); // Esto calcula el número total de páginas

        // Esta sentencia asegurarsa que la página actual esté dentro del rango válido que se le dio anteriormente
        if ($page < 1) {
            $page = 1;
        } elseif ($page > $totalPages) {
            $page = $totalPages;
        }

        // Con esto se calcular el offset para la consulta con offset de la clase
        $offset = ($page - 1) * $limit;

        $datos = $modelo->obtenerRegistrosPaginados($limit, $offset);

        $paginacion = $modelo->generarPaginacion($page, $totalPages);

        $router->renderPages('/paginas/places', [
            'datos' => $datos,
            'paginacion' => $paginacion
        ]);
    }
    
    public static function entrepreneur_all(Router $router)
    {
        // Se obtiene el número de página actual y el número total de páginas por medio de los parámetros de la URL
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $limit = 12; // Cantidad de registros por página

        $modelo = new Entrepreneur();
        $totalRecords = $modelo->obtenerTotalRegistros();

        $totalPages = ceil($totalRecords / $limit); // Esto calcula el número total de páginas

        // Esta sentencia asegurarsa que la página actual esté dentro del rango válido que se le dio anteriormente
        if ($page < 1) {
            $page = 1;
        } elseif ($page > $totalPages) {
            $page = $totalPages;
        }

        // Con esto se calcular el offset para la consulta con offset de la clase
        $offset = ($page - 1) * $limit;

        $datos = $modelo->obtenerRegistrosPaginados($limit, $offset);

        $paginacion = $modelo->generarPaginacion($page, $totalPages);

        $router->renderPages('/paginas/entrepreneurs', [
            'datos' => $datos,
            'paginacion' => $paginacion
        ]);
    }

    public static function place_details(Router $router)
    {
        $Id = validarORedireccionar('/');
        $lugar = Place::find($Id);

        $resultadodiasl = Dayl::allDias();
        $resultadodiasll = Dayll::allDias();
        $resultadoespacio = Space::allTipoEspacio();
        $resultadocategoria = Cate_Place::allCategoriaLugar();

        $router->renderPages('/paginas/place-details', [
            'lugar' => $lugar,
            'resultadodiasl' => $resultadodiasl,
            'resultadodiasll' => $resultadodiasll,
            'resultadoespacio' => $resultadoespacio,
            'resultadocategoria' => $resultadocategoria
        ]);
    }
    
    public static function place_all_details(Router $router)
    {
        $Id = validarORedireccionar('/places');
        $lugar = Place::find($Id);

        $resultadodiasl = Dayl::allDias();
        $resultadodiasll = Dayll::allDias();
        $resultadoespacio = Space::allTipoEspacio();
        $resultadocategoria = Cate_Place::allCategoriaLugar();

        $router->renderPages('/paginas/place-all-details', [
            'lugar' => $lugar,
            'resultadodiasl' => $resultadodiasl,
            'resultadodiasll' => $resultadodiasll,
            'resultadoespacio' => $resultadoespacio,
            'resultadocategoria' => $resultadocategoria
        ]);
    }

    public static function entrepreneur_details(Router $router)
    {

        $Id = validarORedireccionar('/');
        $emprendedor = Entrepreneur::find($Id);

        $resultadocategoria = Cate_Entrepreneur::all();
        $resultadoestado = State::all();
        $ErrFeriaEmprende = Entrepreneur::getErrFeriaEmprende();

        $router->renderPages('/paginas/entrepreneur-details', [
            'emprendedor' => $emprendedor,
            'resultadocategoria' => $resultadocategoria,
            'resultadoestado' => $resultadoestado,
            'ErrFeriaEmprende' => $ErrFeriaEmprende
        ]);
    }
    
    public static function entrepreneur_all_details(Router $router)
    {
        $Id = validarORedireccionar('/paginas/entrepreneurs');
        $emprendedor = Entrepreneur::find($Id);

        $resultadocategoria = Cate_Entrepreneur::all();
        $resultadoestado = State::all();
        $ErrFeriaEmprende = Entrepreneur::getErrFeriaEmprende();

        $router->renderPages('/paginas/entrepreneur-all-details', [
            'emprendedor' => $emprendedor,
            'resultadocategoria' => $resultadocategoria,
            'resultadoestado' => $resultadoestado,
            'ErrFeriaEmprende' => $ErrFeriaEmprende
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



    public static function create_partial_entrepreneur(Router $router)
    {
        session_start();

        $emprendedor = new Entrepreneur;
        $resultadocategoria = Cate_Entrepreneur::all();
        $resultEstado = State::Estado();
        $resultFeriaEmprende = Fair_Entrepreneur::all();

        $errores = Entrepreneur::getErrores();
        $ErrNombNegocio = Entrepreneur::getErrNombNegocio();
        $ErrNombPersona = Entrepreneur::getErrNombPersona();
        $ErrApel = Entrepreneur::getErrApel();
        $ErrApell = Entrepreneur::getErrApell();
        $ErrNombProduct = Entrepreneur::getErrNombProduct();
        $ErrTel = Entrepreneur::getErrTel();
        $ErrCorreo = Entrepreneur::getErrCorreo();
        $ErrActividad = Entrepreneur::getErrActividad();
        $ErrImg = Entrepreneur::getErrImg();
        $ErrCedula = Entrepreneur::getErrCedula();
        $ErrEstado = Entrepreneur::getErrEstado();
        $ErrFeriaEmprende = Entrepreneur::getErrFeriaEmprende();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $emprendedor = new Entrepreneur($_POST['emprendedor']);

            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            //Realiza resize a la imagen con intervation (actualmente no tiene resize)
            if ($_FILES['emprendedor']['tmp_name']['Imagen']) {
                $image = Image::make($_FILES['emprendedor']['tmp_name']['Imagen']);
                $emprendedor->setImagen($nombreImagen);
            }

            $errores = $emprendedor->validar();
            $ErrNombNegocio = $emprendedor->validaErrNombNegocio();
            $ErrNombPersona = $emprendedor->validaErrNombPersona();
            $ErrApel = $emprendedor->validaErrApel();
            $ErrApell = $emprendedor->validaErrApell();
            $ErrNombProduct = $emprendedor->validaErrNombProduct();
            $ErrTel = $emprendedor->validaErrTel();
            $ErrCorreo = $emprendedor->validaErrCorreo();
            $ErrActividad = $emprendedor->validaErrActividad();
            $ErrImg = $emprendedor->validaErrImg();
            $ErrCedula = $emprendedor->validaErrCedula();
            $ErrEstado = $emprendedor->validaErrEstado();
            $ErrFeriaEmprende = $emprendedor->validaErrFeriaEmprende();

            if (empty(($errores) || ($ErrNombNegocio) || ($ErrNombPersona) || ($ErrApel) || ($ErrApell) || ($ErrNombProduct) || ($ErrTel) || ($ErrCorreo)
                || ($ErrActividad) || ($ErrImg) || ($ErrCedula) || ($ErrEstado) || ($ErrFeriaEmprende))) {

                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                $image->save(CARPETA_IMAGENES . $nombreImagen);

                $emprendedor->guardar();

                if ($emprendedor) {
                    $_SESSION['success_message'] = ['title' => '¡Éxito! Solicitud enviada exitosamente'];
                    header('Location: /entrepreneur-form');
                    exit;
                }
            }
        }

        $router->renderPages('/paginas/entrepreneur-form', [
            'errores' => $errores,
            'ErrNombNegocio' => $ErrNombNegocio,
            'ErrNombPersona' => $ErrNombPersona,
            'ErrApel' => $ErrApel,
            'ErrApell' => $ErrApell,
            'ErrApell' => $ErrApell,
            'ErrNombProduct' => $ErrNombProduct,
            'ErrTel' => $ErrTel,
            'ErrCorreo' => $ErrCorreo,
            'ErrActividad' => $ErrActividad,
            'ErrImg' => $ErrImg,
            'ErrCedula' => $ErrCedula,
            'ErrEstado' => $ErrEstado,
            'ErrFeriaEmprende' => $ErrFeriaEmprende,
            'emprendedor' => $emprendedor,
            'resultadocategoria' => $resultadocategoria,
            'resultEstado' => $resultEstado,
            'resultFeriaEmprende' => $resultFeriaEmprende

        ]);
    }


    public static function create_partial_place(Router $router)
    {
        session_start();

        $lugar = new Place;
        $resultadodiasl = Dayl::allDias();
        $resultadodiasll = Dayll::allDias();
        $resultadoespacio = Space::allTipoEspacio();
        $resultadocategoria = Cate_Place::allCategoriaLugar();
        $resultadoestado = StatePlace::Estado();
        $errores = Place::getErrores();
        $ErrNombPer = Place::getErrNombPer();
        $ErrContacto = Place::getErrContacto();
        $ErrDescrip = Place::getErrDescrip();
        $ErrLugar = Place::getErrLugar();
        $ErrHoraI = Place::getErrHoraI();
        $ErrHoraF = Place::getErrHoraF();
        $ErrDiaI = Place::getErrDiaI();
        $ErrDiaF = Place::getErrDiaF();
        $ErrImg = Place::getErrImg();
        $ErrCorreo = Place::getErrCorreo();
        $ErrUbi = Place::getErrUbi();
        $ErrCate = Place::getErrCate();
        $ErrEstado = Place::getErrEstado();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $lugar = new Place($_POST['lugar']);

            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            if ($_FILES['lugar']['tmp_name']['Imagen']) {
                $image = Image::make($_FILES['lugar']['tmp_name']['Imagen']);
                $lugar->setImagen($nombreImagen);
            }

            $errores = $lugar->validar();
            $ErrNombPer = $lugar->validaNombre();
            $ErrContacto = $lugar->validaContacto();
            $ErrDescrip = $lugar->validaDescrip();
            $ErrLugar = $lugar->validaLugar();
            $ErrHoraI = $lugar->validaHoraI();
            $ErrHoraF = $lugar->validaHoraF();
            $ErrDiaI = $lugar->validaDiaI();
            $ErrDiaF = $lugar->validaDiaF();
            $ErrImg = $lugar->validaImg();
            $ErrCorreo = $lugar->validaCorreo();
            $ErrUbi = $lugar->validaUbi();
            $ErrCate = $lugar->validaCate();
            $ErrEstado = $lugar->validaEstado();

            if (empty(($ErrNombPer) || ($ErrContacto) || ($ErrDescrip) || ($ErrLugar) || ($ErrHoraI) || ($ErrHoraF) || ($ErrDiaI)
                || ($ErrDiaF) || ($ErrImg) || ($ErrCorreo) || ($ErrUbi) || ($ErrCate) || ($errores) || ($ErrEstado))) {

                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                $image->save(CARPETA_IMAGENES . $nombreImagen);
                $lugar->guardar();
                if ($lugar) {
                    $_SESSION['success_message'] = ['title' => '¡Éxito! Solicitud enviada exitosamente'];
                    header('Location: /tourist-places_form');
                    exit;
                }
            }
        }

        $router->renderPages('/paginas/tourist-places_form', [
            'errores' => $errores,
            'ErrNombPer' => $ErrNombPer,
            'ErrContacto' => $ErrContacto,
            'ErrDescrip' => $ErrDescrip,
            'ErrLugar' => $ErrLugar,
            'ErrHoraI' => $ErrHoraI,
            'ErrHoraF' => $ErrHoraF,
            'ErrDiaI' => $ErrDiaI,
            'ErrDiaF' => $ErrDiaF,
            'ErrImg' => $ErrImg,
            'ErrCorreo' => $ErrCorreo,
            'ErrUbi' => $ErrUbi,
            'ErrCate' => $ErrCate,
            'ErrEstado' => $ErrEstado,
            'lugar' => $lugar,
            'resultadodiasl' => $resultadodiasl,
            'resultadodiasll' => $resultadodiasll,
            'resultadoespacio' => $resultadoespacio,
            'resultadocategoria' => $resultadocategoria,
            'resultadoestado' => $resultadoestado
        ]);
    }
}
