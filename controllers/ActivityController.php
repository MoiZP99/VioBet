<?php

namespace Controllers;

use MVC\Router;
use Model\Age;
use Model\Activity;
use Model\StateActivity;
use Model\DayActivity;
use Intervention\Image\ImageManagerStatic as Image;

class ActivityController
{
    public static function index(Router $router)
    {
        $actividad = Activity::innerJoin();

        $router->render('/activities/index', [
            'actividad' => $actividad
        ]);
    }


    public static function create(Router $router)
    {
        session_start();

        $errores = Activity::getErrores();
        $ErrNombActivity = Activity::getErrNombActivity();
        $ErrTel = Activity::getErrTel();
        $ErrHI = Activity::getErrHI();
        $ErrHF = Activity::getErrHF();
        $ErrDescrip = Activity::getErrDescrip();
        $ErrEdad = Activity::getErrEdad();
        $ErrCorreo = Activity::getErrCorreo();
        $ErrActividad = Activity::getErrActividad();
        $ErrUbi = Activity::getErrUbi();
        $ErrImg = Activity::getErrImg();
        $ErrEstado = Activity::getErrEstado();

        $actividad = new Activity;
        $resultadoedad = Age::all();
        $resultadoestado = StateActivity::all();
        $resultadodias = DayActivity::allDias();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $actividad = new Activity($_POST['actividad']);

            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            //Realiza resize a la imagen con intervation (actualmente no tiene resize)
            if ($_FILES['actividad']['tmp_name']['Imagen']) {
                $image = Image::make($_FILES['actividad']['tmp_name']['Imagen']);
                $actividad->setImagen($nombreImagen);
            }

            $errores = $actividad->validar();
            $ErrNombActivity = $actividad->validaErrNombNegocio();
            $ErrTel = $actividad->validaErrTel();
            $ErrHI = $actividad->validaErrHI();
            $ErrHF = $actividad->validaErrHF();
            $ErrDescrip = $actividad->validaErrDescrip();
            $ErrEdad = $actividad->validaErrEdad();
            $ErrCorreo = $actividad->validaErrCorreo();
            $ErrActividad = $actividad->validaErrActividad();
            $ErrUbi = $actividad->validaErrUbi();
            $ErrImg = $actividad->validaErrImg();
            $ErrEstado = $actividad->validaErrEstado();

            if (empty(($errores) || ($ErrNombActivity) || ($ErrTel) || ($ErrHI) || ($ErrHF) || ($ErrDescrip) || ($ErrEdad)
                || ($ErrCorreo) || ($ErrActividad) || ($ErrUbi) || ($ErrImg) || ($ErrEstado))) {

                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                $image->save(CARPETA_IMAGENES . $nombreImagen);

                $actividad->guardar();
                if ($actividad) {
                    $_SESSION['success_message'] = ['title' => '¡Éxito! Actividad guardada exitosamente'];
                    header('Location: /activities/create');
                    exit;
                }
            }
        }

        $router->render('/activities/create', [
            'errores' => $errores,
            'ErrNombActivity' => $ErrNombActivity,
            'ErrTel' => $ErrTel,
            'ErrHI' => $ErrHI,
            'ErrHF' => $ErrHF,
            'ErrDescrip' => $ErrDescrip,
            'ErrEdad' => $ErrEdad,
            'ErrCorreo' => $ErrCorreo,
            'ErrActividad' => $ErrActividad,
            'ErrUbi' => $ErrUbi,
            'ErrImg' => $ErrImg,
            'ErrEstado' => $ErrEstado,
            'actividad' => $actividad,
            'resultadoedad' => $resultadoedad,
            'resultadoestado' => $resultadoestado,
            'resultadodias' => $resultadodias
        ]);
    }


    public static function update(Router $router)
    {
        $Id = validarORedireccionar('/activities/index');

        $actividad = Activity::find($Id);
        $resultadoedad = Age::all();
        $resultadoestado = StateActivity::all();
        $resultadodias = DayActivity::allDias();

        $errores = Activity::getErroresActualizar();
        $ErrNombActivity = Activity::getErrNombActivity();
        $ErrTel = Activity::getErrTel();
        $ErrHI = Activity::getErrHI();
        $ErrHF = Activity::getErrHF();
        $ErrDescrip = Activity::getErrDescrip();
        $ErrEdad = Activity::getErrEdad();
        $ErrCorreo = Activity::getErrCorreo();
        $ErrActividad = Activity::getErrActividad();
        $ErrUbi = Activity::getErrUbi();
        $ErrEstado = Activity::getErrEstado();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $args = $_POST['actividad'];

            $actividad->sincronizar($args);

            $errores = $actividad->validarActualizar();
            $ErrNombActivity = $actividad->validaErrNombNegocio();
            $ErrTel = $actividad->validaErrTel();
            $ErrHI = $actividad->validaErrHI();
            $ErrHF = $actividad->validaErrHF();
            $ErrDescrip = $actividad->validaErrDescrip();
            $ErrEdad = $actividad->validaErrEdad();
            $ErrCorreo = $actividad->validaErrCorreo();
            $ErrActividad = $actividad->validaErrActividad();
            $ErrUbi = $actividad->validaErrUbi();
            $ErrEstado = $actividad->validaErrEstado();

            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            if ($_FILES['actividad']['tmp_name']['Imagen']) {
                $image = Image::make($_FILES['actividad']['tmp_name']['Imagen']);
                $actividad->setImagen($nombreImagen);
            }

            if (empty(($errores) || ($ErrNombActivity) || ($ErrTel) || ($ErrHI) || ($ErrHF) || ($ErrDescrip) || ($ErrEdad)
                || ($ErrCorreo) || ($ErrActividad) || ($ErrUbi) || ($ErrEstado))) {

                if ($_FILES['actividad']['tmp_name']['Imagen']) {
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }

                $actividad->guardar();
            }
        }

        $router->render('/activities/update', [
            'actividad' => $actividad,
            'resultadoedad' => $resultadoedad,
            'resultadoestado' => $resultadoestado,
            'errores' => $errores,
            'ErrNombActivity' => $ErrNombActivity,
            'ErrTel' => $ErrTel,
            'ErrHI' => $ErrHI,
            'ErrHF' => $ErrHF,
            'ErrDescrip' => $ErrDescrip,
            'ErrEdad' => $ErrEdad,
            'ErrCorreo' => $ErrCorreo,
            'ErrActividad' => $ErrActividad,
            'ErrUbi' => $ErrUbi,
            'ErrEstado' => $ErrEstado,
            'resultadodias' => $resultadodias
        ]);
    }


    public static function details(Router $router)
    {
        $Id = validarORedireccionar('/activities/index');

        $actividad = Activity::find($Id);

        $resultadoedad = Age::all();
        $resultadoestado = StateActivity::all();
        $resultadodias = DayActivity::allDias();

        $router->render('/activities/details', [
            'actividad' => $actividad,
            'resultadoedad' => $resultadoedad,
            'resultadoestado' => $resultadoestado,
            'resultadodias' => $resultadodias
        ]);
        }


    public static function delete(Router $router)
    {
        $Id = validarORedireccionar('/activities/index');

        $actividad = Activity::find($Id);

        $resultadoedad = Age::all();
        $resultadoestado = StateActivity::all();

        $router->render('/activities/delete', [
            'actividad' => $actividad,
            'resultadoedad' => $resultadoedad,
            'resultadoestado' => $resultadoestado
        ]);
    }


    public static function delete_partial(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $Id = $_POST['Id'];
            $Id = filter_var($Id, FILTER_VALIDATE_INT);
            if ($Id) {
                $actividad = Activity::find($Id);
                $actividad->eliminar();
            }
        }

        $router->render('/activities/delete/delete_partial', [
            'actividad' => $actividad
        ]);
    }


    public static function report_excel(Router $router)
    {
        $actividades = Activity::innerJoin();

        $router->render('/activities/report_excel', [
            'actividades' => $actividades
        ]);
    }


    public static function report_pdf(Router $router)
    {
        $actividades = Activity::innerJoin();

        $router->render('/activities/report_pdf', [
            'actividades' => $actividades
        ]);
    }
}
