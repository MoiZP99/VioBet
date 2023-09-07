<?php

namespace Controllers;

use MVC\Router;
use Model\Entrepreneur;
use Model\Cate_Entrepreneur;
use Intervention\Image\ImageManagerStatic as Image;
use Model\Fair_Entrepreneur;
use Model\State;

class EntrepreneurController
{
    public static function index(Router $router)
    {
        $emprendedores = Entrepreneur::innerJoin();
        $emprendeSolicitud = Entrepreneur::innerJoinSolicitud();

        $router->render('/entrepreneurs/index', [
            'emprendedores' => $emprendedores,
            'emprendeSolicitud' => $emprendeSolicitud
        ]);
    }


    public static function create(Router $router)
    {
        session_start();

        $emprendedor = new Entrepreneur;
        $resultadocategoria = Cate_Entrepreneur::all();
        $resultadoestado = State::all();
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

            if (empty(($ErrNombNegocio) || ($ErrNombPersona) || ($ErrApel) || ($ErrApell) || ($ErrNombProduct) || ($ErrTel) || ($ErrCorreo)
                || ($ErrActividad) || ($ErrImg) || ($ErrCedula) || ($ErrEstado) || ($errores) || ($ErrFeriaEmprende))) {

                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                $image->save(CARPETA_IMAGENES . $nombreImagen);

                $emprendedor->guardar();
                if ($emprendedor) {
                    $_SESSION['success_message'] = ['title' => '¡Éxito! Emprendimiento guardado exitosamente'];
                    header('Location: /entrepreneurs/create');
                    exit;
                }
            }
        }

        $router->render('/entrepreneurs/create', [
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
            'resultadoestado' => $resultadoestado,
            'resultFeriaEmprende' => $resultFeriaEmprende

        ]);
    }


    public static function update(Router $router)
    {
        $Id = validarORedireccionar('/entrepreneurs/index');

        $emprendedor = Entrepreneur::find($Id);
        $resultadocategoria = Cate_Entrepreneur::all();
        $resultadoestado = State::all();
        $resultFeriaEmprende = Fair_Entrepreneur::all();

        $erroresActualizar = Entrepreneur::getErroresActualizar();
        $ErrNombNegocio = Entrepreneur::getErrNombNegocio();
        $ErrNombPersona = Entrepreneur::getErrNombPersona();
        $ErrApel = Entrepreneur::getErrApel();
        $ErrApell = Entrepreneur::getErrApell();
        $ErrNombProduct = Entrepreneur::getErrNombProduct();
        $ErrTel = Entrepreneur::getErrTel();
        $ErrCorreo = Entrepreneur::getErrCorreo();
        $ErrActividad = Entrepreneur::getErrActividad();
        $ErrImg = Entrepreneur::getErrImg();
        $ErrEstado = Entrepreneur::getErrEstado();
        $ErrFeriaEmprende = Entrepreneur::getErrFeriaEmprende();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $args = $_POST['emprendedor'];

            $emprendedor->sincronizar($args);

            $erroresActualizar = $emprendedor->validarActualizar();
            $ErrNombNegocio = $emprendedor->validaErrNombNegocio();
            $ErrNombPersona = $emprendedor->validaErrNombPersona();
            $ErrApel = $emprendedor->validaErrApel();
            $ErrApell = $emprendedor->validaErrApell();
            $ErrNombProduct = $emprendedor->validaErrNombProduct();
            $ErrTel = $emprendedor->validaErrTel();
            $ErrCorreo = $emprendedor->validaErrCorreo();
            $ErrActividad = $emprendedor->validaErrActividad();
            $ErrImg = $emprendedor->validaErrImg();
            $ErrEstado = $emprendedor->validaErrEstado();
            $ErrFeriaEmprende = $emprendedor->validaErrFeriaEmprende();

            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            //Realiza resize a la imagen con intervation (actualmente no tiene resize)
            if ($_FILES['emprendedor']['tmp_name']['Imagen']) {
                $image = Image::make($_FILES['emprendedor']['tmp_name']['Imagen']);
                $emprendedor->setImagen($nombreImagen);
            }

            if (empty(($ErrNombNegocio) || ($ErrNombPersona) || ($ErrApel) || ($ErrApell) || ($ErrNombProduct) || ($ErrTel) || ($ErrCorreo)
                || ($ErrActividad) || ($ErrImg) || ($ErrEstado) || ($erroresActualizar) || ($ErrFeriaEmprende))) {

                if ($_FILES['emprendedor']['tmp_name']['Imagen']) {
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }

                $emprendedor->guardar();
            }
        }

        $router->render('entrepreneurs/update', [
            'erroresActualizar' => $erroresActualizar,
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
            'ErrEstado' => $ErrEstado,
            'ErrFeriaEmprende' => $ErrFeriaEmprende,
            'emprendedor' => $emprendedor,
            'resultadocategoria' => $resultadocategoria,
            'resultadoestado' => $resultadoestado,
            'resultFeriaEmprende' => $resultFeriaEmprende

        ]);
    }


    public static function details(Router $router)
    {
        $Id = validarORedireccionar('/entrepreneurs/index');

        $emprendedor = Entrepreneur::find($Id);

        $resultadocategoria = Cate_Entrepreneur::all();
        $resultadoestado = State::all();
        $ErrFeriaEmprende = Entrepreneur::getErrFeriaEmprende();
        $resultFeriaEmprende = Fair_Entrepreneur::all();

        $router->render('/entrepreneurs/details', [
            'emprendedor' => $emprendedor,
            'resultadocategoria' => $resultadocategoria,
            'resultadoestado' => $resultadoestado,
            'ErrFeriaEmprende' => $ErrFeriaEmprende,
            'resultFeriaEmprende' => $resultFeriaEmprende

        ]);
    }


    public static function delete(Router $router)
    {
        $Id = validarORedireccionar('/entrepreneurs/index');

        $emprendedor = Entrepreneur::find($Id);

        $resultadocategoria = Cate_Entrepreneur::all();
        $resultadoestado = State::all();
        $ErrFeriaEmprende = Entrepreneur::getErrFeriaEmprende();
        $resultFeriaEmprende = Fair_Entrepreneur::all();

        $router->render('/entrepreneurs/delete', [
            'emprendedor' => $emprendedor,
            'resultadocategoria' => $resultadocategoria,
            'resultadoestado' => $resultadoestado,
            'ErrFeriaEmprende' => $ErrFeriaEmprende,
            'resultFeriaEmprende' => $resultFeriaEmprende
        ]);
    }


    public static function delete_partial(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $Id = $_POST['Id'];
            $Id = filter_var($Id, FILTER_VALIDATE_INT);
            if ($Id) {
                $emprendedor = Entrepreneur::find($Id);
                $emprendedor->eliminar();
            }
        }

        $router->render('/entrepreneurs/delete/delete_partial', [
            'emprendedor' => $emprendedor

        ]);
    }

    public static function report_excel(Router $router)
    {
        $emprendedores = Entrepreneur::innerJoin();

        $router->render('/entrepreneurs/report_excel', [
            'emprendedores' => $emprendedores
        ]);
    }

    public static function report_pdf(Router $router)
    {
        $opcion = isset($_POST['opcion']) ? $_POST['opcion'] : 'todo';

        $reportPDF = Entrepreneur::reportPDF($opcion);

        $router->render('entrepreneurs/report_pdf', [
            'reportPDF' => $reportPDF
        ]);
    }
}
