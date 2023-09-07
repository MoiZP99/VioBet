<?php

namespace Controllers;

use MVC\Router;
use Model\Gastronomy;
use Model\Cate_Gastronomy;
use Intervention\Image\ImageManagerStatic as Image;
use Model\DaylGastronomie;
use Model\DayllGastronomie;
use Model\StateGastronomy;

class GastronomyController
{
    public static function index(Router $router)
    {
        $gastronomias = Gastronomy::innerJoin();

        $router->render('/gastronomies/index', [
            'gastronomias' => $gastronomias
        ]);
    }


    public static function create(Router $router)
    {
        session_start();
        
        $errores = Gastronomy::getErrores();
        $ErrNombServicio = Gastronomy::getErrNombServicio();
        $ErrDescrip = Gastronomy::getErrDescrip();
        $ErrUbi = Gastronomy::getErrUbi();
        $ErrHF = Gastronomy::getErrHI();
        $ErrHF = Gastronomy::getErrHF();
        $ErrDI = Gastronomy::getErrDI();
        $ErrDF = Gastronomy::getErrDF();
        $ErrTel = Gastronomy::getErrTel();
        $ErrCorreo = Gastronomy::getErrCorreo();
        $ErrCate = Gastronomy::getErrCate();
        $ErrImg = Gastronomy::getErrImg();
        $ErrEstado = Gastronomy::getErrEstado();

        $gastronomia = new Gastronomy;
        $resultadodias = DaylGastronomie::allDias();
        $resultadodias2 = DayllGastronomie::allDias();
        $resultadoCCategoria = Cate_Gastronomy::allCategoriaGastronomia();
        $resultadoestado = StateGastronomy::all();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $gastronomia = new Gastronomy($_POST['gastronomia']);

            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            //Realiza resize a la imagen con intervation (actualmente no tiene resize)
            if ($_FILES['gastronomia']['tmp_name']['Imagen']) {
                $image = Image::make($_FILES['gastronomia']['tmp_name']['Imagen']);
                $gastronomia->setImagen($nombreImagen);
            }

            $errores = $gastronomia->validar();
            $ErrNombServicio = $gastronomia->validaErrNombServicio();
            $ErrDescrip = $gastronomia->validaErrDescrip();
            $ErrUbi = $gastronomia->validaErrUbi();
            $ErrHI = $gastronomia->validaErrHI();
            $ErrHF = $gastronomia->validaErrHF();
            $ErrDI = $gastronomia->validaErrDI();
            $ErrDF = $gastronomia->validaErrDF();
            $ErrTel = $gastronomia->validaErrTel();
            $ErrCorreo = $gastronomia->validaErrCorreo();
            $ErrCate = $gastronomia->validaErrCate();
            $ErrImg = $gastronomia->validaErrImg();
            $ErrEstado = $gastronomia->validaErrEstado();

            if (empty(($errores) || ($ErrNombServicio) || ($ErrDescrip) || ($ErrUbi) || ($ErrHI) || ($ErrHF) || ($ErrDI)
                || ($ErrDF) || ($ErrTel) || ($ErrCorreo) || ($ErrCate) || ($ErrImg) || ($ErrEstado))) {

                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                //guarda la imagen en el servidor
                //Se le pasa el nombre de la carpteta, para que no lo guarde con la referencia de FILES
                $image->save(CARPETA_IMAGENES . $nombreImagen);

                $gastronomia->guardar();
                if ($gastronomia) {
                    $_SESSION['success_message'] = ['title' => '¡Éxito! Gastronomía guardada exitosamente'];
                    header('Location: /gastronomies/create');
                    exit;
                }
            }
        }

        $router->render('/gastronomies/create', [
            'errores' => $errores,
            'ErrNombServicio' => $ErrNombServicio,
            'ErrDescrip' => $ErrDescrip,
            'ErrUbi' => $ErrUbi,
            'ErrHI' => $ErrHI,
            'ErrHF' => $ErrHF,
            'ErrDI' => $ErrDI,
            'ErrDF' => $ErrDF,
            'ErrTel' => $ErrTel,
            'ErrCorreo' => $ErrCorreo,
            'ErrCate' => $ErrCate,
            'ErrImg' => $ErrImg,
            'ErrEstado' => $ErrEstado,
            'gastronomia' => $gastronomia,
            'resultadodias' => $resultadodias,
            'resultadodias2' => $resultadodias2,
            'resultadoCCategoria' => $resultadoCCategoria,
            'resultadoestado' => $resultadoestado
        ]);
    }


    public static function update(Router $router)
    {
        $Id = validarORedireccionar('/gastronomies/index');

        $gastronomia = Gastronomy::find($Id);

        $resultadodias = DaylGastronomie::allDias();
        $resultadodias2 = DayllGastronomie::allDias();
        $resultadoCCategoria = Cate_Gastronomy::allCategoriaGastronomia();
        $resultadoestado = StateGastronomy::all();

        $errores = Gastronomy::getErrores();
        $ErrNombServicio = Gastronomy::getErrNombServicio();
        $ErrDescrip = Gastronomy::getErrDescrip();
        $ErrUbi = Gastronomy::getErrUbi();
        $ErrHI = Gastronomy::getErrHI();
        $ErrHF = Gastronomy::getErrHF();
        $ErrDI = Gastronomy::getErrDI();
        $ErrDF = Gastronomy::getErrDF();
        $ErrTel = Gastronomy::getErrTel();
        $ErrCorreo = Gastronomy::getErrCorreo();
        $ErrCate = Gastronomy::getErrCate();
        $ErrImg = Gastronomy::getErrImg();
        $ErrEstado = Gastronomy::getErrEstado();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $args = $_POST['gastronomia'];

            $gastronomia->sincronizar($args);

            $errores = $gastronomia->validar();
            $ErrNombServicio = $gastronomia->validaErrNombServicio();
            $ErrDescrip = $gastronomia->validaErrDescrip();
            $ErrUbi = $gastronomia->validaErrUbi();
            $ErrHI = $gastronomia->validaErrHI();
            $ErrHF = $gastronomia->validaErrHF();
            $ErrDI = $gastronomia->validaErrDI();
            $ErrDF = $gastronomia->validaErrDF();
            $ErrTel = $gastronomia->validaErrTel();
            $ErrCorreo = $gastronomia->validaErrCorreo();
            $ErrCate = $gastronomia->validaErrCate();
            $ErrImg = $gastronomia->validaErrImg();
            $ErrEstado = $gastronomia->validaErrEstado();

            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            if ($_FILES['gastronomia']['tmp_name']['Imagen']) {
                $image = Image::make($_FILES['gastronomia']['tmp_name']['Imagen']);
                $gastronomia->setImagen($nombreImagen);
            }

            if (empty(($errores) || ($ErrNombServicio) || ($ErrDescrip) || ($ErrUbi) || ($ErrHI) || ($ErrHF) || ($ErrDI)
                || ($ErrDF) || ($ErrTel) || ($ErrCorreo) || ($ErrCate) || ($ErrImg) || ($ErrEstado))) {

                if ($_FILES['gastronomia']['tmp_name']['Imagen']) {
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }

                $gastronomia->guardar();
            }
        }

        $router->render('/gastronomies/update', [
            'errores' => $errores,
            'gastronomia' => $gastronomia,
            'resultadodias' => $resultadodias,
            'resultadodias2' => $resultadodias2,
            'resultadoCCategoria' => $resultadoCCategoria,
            'resultadoestado' => $resultadoestado,
            'ErrNombServicio' => $ErrNombServicio,
            'ErrDescrip' => $ErrDescrip,
            'ErrUbi' => $ErrUbi,
            'ErrHI' => $ErrHI,
            'ErrHF' => $ErrHF,
            'ErrDI' => $ErrDI,
            'ErrDF' => $ErrDF,
            'ErrTel' => $ErrTel,
            'ErrCorreo' => $ErrCorreo,
            'ErrCate' => $ErrCate,
            'ErrImg' => $ErrImg,
            'ErrEstado' => $ErrEstado
        ]);
    }


    public static function details(Router $router)
    {
        $Id = validarORedireccionar('/gastronomies/index');

        $gastronomia = Gastronomy::find($Id);

        $resultadodias = DaylGastronomie::allDias();
        $resultadodias2 = DayllGastronomie::allDias();
        $resultadoCCategoria = Cate_Gastronomy::allCategoriaGastronomia();
        $resultadoestado = StateGastronomy::all();

        $router->render('/gastronomies/details', [
            'gastronomia' => $gastronomia,
            'resultadodias' => $resultadodias,
            'resultadodias2' => $resultadodias2,
            'resultadoCCategoria' => $resultadoCCategoria,
            'resultadoestado' => $resultadoestado
        ]);
    }


    public static function report_excel(Router $router)
    {
        $gastronomias = Gastronomy::innerJoin();

        $router->render('/gastronomies/report_excel', [
            'gastronomias' => $gastronomias
        ]);
    }


    public static function report_pdf(Router $router)
    {
        $gastronomias = Gastronomy::innerJoin();

        $router->render('/gastronomies/report_pdf', [
            'gastronomias' => $gastronomias
        ]);
    }

    public static function delete(Router $router)
    {
        $Id = validarORedireccionar('/gastronomies/index');

        $gastronomia = Gastronomy::find($Id);

        $resultadodias = DaylGastronomie::allDias();
        $resultadodias2 = DayllGastronomie::allDias();
        $resultadoCCategoria = Cate_Gastronomy::allCategoriaGastronomia();
        $resultadoestado = StateGastronomy::all();

        $router->render('/gastronomies/delete', [
            'gastronomia' => $gastronomia,
            'resultadodias' => $resultadodias,
            'resultadodias2' => $resultadodias2,
            'resultadoCCategoria' => $resultadoCCategoria,
            'resultadoestado' => $resultadoestado
        ]);
        
    }

    public static function delete_partial(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $Id = $_POST['Id'];
            $Id = filter_var($Id, FILTER_VALIDATE_INT);
            if ($Id) {
                //Obtener DATOS de Los Lugares desde la base de datos
                $categoria = Gastronomy::find($Id);
                $categoria->eliminar();
            }
        }

        $router->render('/gastronomies/delete/delete_partial', [
            'categoria' => $categoria
        ]);
    }
}
