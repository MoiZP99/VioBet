<?php


define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');


function incluirTemplate( string  $nombre, bool $inicio = false ) {
    include TEMPLATES_URL . "/${nombre}.php"; 
}

function estaAutenticado() {
    session_start();

    if(!$_SESSION['login']) {
        header('Location: /');
    }
}

function debuguear($variable) {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}


// Valida tipo de petición
function validarTipoContenido($tipo){
    $tipos = ['vendedor', 'propiedad'];
    return in_array($tipo, $tipos);
}

// Muestra los mensajes
function mostrarNotificacion($codigo) {
    $mensaje = '';

    switch ($codigo) {
        case 1:
            $mensaje = 'Propiedad Creada Correctamente';
            break;
        case 2:
            $mensaje = 'Propiedad Actualizada Correctamente';
            break;
        case 3:
            $mensaje = 'Propiedad Eliminada Correctamente';
            break;
        case 4:
            $mensaje = 'Vendedor Registrado Correctamente';
            break;
        case 5:
            $mensaje = 'Vendedor Actualizado Correctamente';
            break;
        case 6:
            $mensaje = 'Vendedor Eliminado Correctamente';
            break;
        default:
            $mensaje = false;
            break;
    }
    return $mensaje;
}

function validarORedireccionar(string $url) {
    $Id = $_GET['Id'];
    $Id = filter_var($Id, FILTER_VALIDATE_INT);

    if(!$Id) {
        header("Location: $url " );
    }

    return $Id;
}
function validarORedireccionarUser(string $url) {
    $IdUsuario = $_GET['IdUsuario'];
    $IdUsuario = filter_var($IdUsuario, FILTER_VALIDATE_INT);

    if(!$IdUsuario) {
        header("Location: $url " );
    }

    return $IdUsuario;
}

function validarORedireccionarFinca(string $url) {
    $IdFinca = $_GET['IdFinca'];
    $IdFinca = filter_var($IdFinca, FILTER_VALIDATE_INT);

    if(!$IdFinca) {
        header("Location: $url " );
    }

    return $IdFinca;
}

function validarORedireccionarAnimal(string $url) {
    $IdAnimal = $_GET['IdAnimal'];
    $IdAnimal = filter_var($IdAnimal, FILTER_VALIDATE_INT);

    if(!$IdAnimal) {
        header("Location: $url " );
    }

    return $IdAnimal;
}