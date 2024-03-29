<?php

require 'funciones.php';
require 'database.php';
require __DIR__ .'/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

//Conenectarnos a la base de datos
$db = conectarDB();

//Clase Padre
use Model\FichaMedica;
use Model\Animal;
use Model\Finca;
use Model\User;
use Model\Login;
use Model\DtCruce;
use Model\Historial;

FichaMedica::setDB($db);
Animal::setDB($db);
Finca::setDB($db);
User::setDB($db);
Login::setDB($db);
DtCruce::setDB($db);
Historial::setDB($db);
