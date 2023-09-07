<?php

namespace Controllers;

use MVC\Router;
use Model\Place;
use Model\Space;
use Model\Cate_Place;
use Intervention\Image\ImageManagerStatic as Image;
use Model\Dayl;
use Model\Dayll;
use Model\StatePlace;

class PlaceController
{
    public static function index(Router $router)
    {
        $lugares = Place::innerJoin();
        $lugarSolicitud = Place::innerJoinSolicitud();

        $router->render('/places/index', [
            'lugares' => $lugares,
            'lugarSolicitud' => $lugarSolicitud
        ]);
    }

    public static function create(Router $router)
    {
        session_start();

        $lugar = new Place;
        $resultadodiasl = Dayl::allDias();
        $resultadodiasll = Dayll::allDias();
        $resultadoespacio = Space::allTipoEspacio();
        $resultadocategoria = Cate_Place::allCategoriaLugar();
        $resultadoestado = StatePlace::all();
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

            $nombreImagen = md5(uniqid(rand(), true));
            // $rutaImagen = CARPETA_IMAGENES . $nombreImagen;

            if ($_FILES['lugar']['tmp_name']['Imagen']) {
                $extension = $_FILES['lugar']['type']['Imagen'];

                // Lista de extensiones permitidas
                $extensionesPermitidas = array('image/jpeg', 'image/jpg');

                // Verificar si la extensión es .jpg o .jpeg
                if (in_array($extension, $extensionesPermitidas)) {
                    // Cargar la imagen utilizando Intervention Image
                    $image = Image::make($_FILES['lugar']['tmp_name']['Imagen']);

                    // Redimensionar la imagen a la resolución deseada y agrandar si es necesario
                    $image->resize(794, 595, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });

                    // Convertir la imagen a formato WebP
                    $image->encode('webp');

                    // Guardar la imagen temporalmente en el directorio de destino
                    $rutaImagen = CARPETA_IMAGENES . $nombreImagen . '.webp';
                    $image->save($rutaImagen);

                    $lugar->setImagen($nombreImagen . '.webp');
                }
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

                $lugar->guardar();
                rename($rutaImagen, CARPETA_IMAGENES . $nombreImagen . '.webp');
                if ($lugar) {
                    $_SESSION['success_message'] = ['title' => '¡Éxito! Lugar Turístico guardado exitosamente'];
                    header('Location: /places/create');
                    exit;
                }
            }
        }

        $router->render('/places/create', [
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


    public static function update(Router $router)
    {
        $Id = validarORedireccionar('/places/index');

        $lugar = Place::find($Id);


        $resultadodiasl = Dayl::allDias();
        $resultadodiasll = Dayll::allDias();
        $resultadoespacio = Space::allTipoEspacio();
        $resultadocategoria = Cate_Place::allCategoriaLugar();
        $resultadoestado = StatePlace::all();

        $errores = Place::getErrores();
        $ErrNombPer = Place::getErrNombPer();
        $ErrContacto = Place::getErrContacto();
        $ErrDescrip = Place::getErrDescrip();
        $ErrLugar = Place::getErrLugar();
        $ErrHoraI = Place::getErrHoraI();
        $ErrHoraF = Place::getErrHoraF();
        $ErrDiaI = Place::getErrDiaI();
        $ErrDiaF = Place::getErrDiaF();
        $ErrCorreo = Place::getErrCorreo();
        $ErrUbi = Place::getErrUbi();
        $ErrCate = Place::getErrCate();
        $ErrEstado = Place::getErrEstado();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $args = $_POST['lugar'];

            $lugar->sincronizar($args);

            $errores = $lugar->validar();
            $ErrNombPer = $lugar->validaNombre();
            $ErrContacto = $lugar->validaContacto();
            $ErrDescrip = $lugar->validaDescrip();
            $ErrLugar = $lugar->validaLugar();
            $ErrHoraI = $lugar->validaHoraI();
            $ErrHoraF = $lugar->validaHoraF();
            $ErrDiaI = $lugar->validaDiaI();
            $ErrDiaF = $lugar->validaDiaF();
            $ErrCorreo = $lugar->validaCorreo();
            $ErrUbi = $lugar->validaUbi();
            $ErrCate = $lugar->validaCate();
            $ErrEstado = $lugar->validaEstado();

            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            if ($_FILES['lugar']['tmp_name']['Imagen']) {
                $image = Image::make($_FILES['lugar']['tmp_name']['Imagen']);
                $lugar->setImagen($nombreImagen);
            }

            if (empty(($ErrNombPer) || ($ErrContacto) || ($ErrDescrip) || ($ErrLugar) || ($ErrHoraI) || ($ErrHoraF) || ($ErrDiaI)
                || ($ErrDiaF) || ($ErrCorreo) || ($ErrUbi) || ($ErrCate) || ($errores) || ($ErrEstado))) {

                if ($_FILES['lugar']['tmp_name']['Imagen']) {
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }

                $lugar->guardar();
            }
        }

        $router->render('/places/update', [
            'ErrNombPer' => $ErrNombPer,
            'ErrContacto' => $ErrContacto,
            'ErrDescrip' => $ErrDescrip,
            'ErrLugar' => $ErrLugar,
            'ErrHoraI' => $ErrHoraI,
            'ErrHoraF' => $ErrHoraF,
            'ErrDiaI' => $ErrDiaI,
            'ErrDiaF' => $ErrDiaF,
            'ErrCorreo' => $ErrCorreo,
            'ErrUbi' => $ErrUbi,
            'ErrCate' => $ErrCate,
            'ErrEstado' => $ErrEstado,
            'lugar' => $lugar,
            'resultadodiasl' => $resultadodiasl,
            'resultadodiasll' => $resultadodiasll,
            'resultadoespacio' => $resultadoespacio,
            'resultadocategoria' => $resultadocategoria,
            'resultadoestado' => $resultadoestado,
            'errores' => $errores
        ]);
    }


    public static function details(Router $router)
    {
        $Id = validarORedireccionar('/places/index');

        $lugar = Place::find($Id);

        $resultadodiasl = Dayl::allDias();
        $resultadodiasll = Dayll::allDias();
        $resultadoespacio = Space::allTipoEspacio();
        $resultadocategoria = Cate_Place::allCategoriaLugar();
        $resultadoestado = StatePlace::all();

        $router->render('/places/details', [
            'lugar' => $lugar,
            'resultadodiasl' => $resultadodiasl,
            'resultadodiasll' => $resultadodiasll,
            'resultadoespacio' => $resultadoespacio,
            'resultadocategoria' => $resultadocategoria,
            'resultadoestado' => $resultadoestado
        ]);
    }

    public static function delete(Router $router)
    {
        $Id = validarORedireccionar('/places/index');

        $lugar = Place::find($Id);

        $resultadodiasl = Dayl::allDias();
        $resultadodiasll = Dayll::allDias();
        $resultadoespacio = Space::allTipoEspacio();
        $resultadocategoria = Cate_Place::allCategoriaLugar();
        $resultadoestado = StatePlace::all();

        $router->render('/places/delete', [
            'lugar' => $lugar,
            'resultadodiasl' => $resultadodiasl,
            'resultadodiasll' => $resultadodiasll,
            'resultadoespacio' => $resultadoespacio,
            'resultadocategoria' => $resultadocategoria,
            'resultadoestado' => $resultadoestado
        ]);
    }

    public static function delete_partial(Router $router)
    {
        $Id = $_POST['Id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $Id = filter_var($Id, FILTER_VALIDATE_INT);
            if ($Id) {
                $categoria = place::find($Id);
                $categoria->eliminar();
            }
        }

        $router->render('/places/delete/delete_partial', [
            'categoria' => $categoria
        ]);
    }


    public static function report_excel(Router $router)
    {
        $lugares = Place::innerJoin();

        $router->render('places/report_excel', [
            'lugares' => $lugares
        ]);
    }

    public static function report_pdf(Router $router)
    {
        $opcion = isset($_POST['opcion']) ? $_POST['opcion'] : 'todo';

        $reportPDF = Place::innerPDF($opcion);

        $router->render('places/report_pdf', [
            'reportPDF' => $reportPDF
        ]);
    }
}
