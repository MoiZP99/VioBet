<?php

require 'funciones.php';
require 'config/database.php';
require __DIR__ .'/../vendor/autoload.php';

//Conenectarnos a la base de datos
$db = conectarDB();

//Clase Padre
use Model\Animal;
use Model\Finca;
use Model\User;
use Model\Role;
use Model\Login;

Animal::setDB($db);
Finca::setDB($db);
User::setDB($db);
Role::setDB($db);
Login::setDB($db);
