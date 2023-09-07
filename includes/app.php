<?php

require 'funciones.php';
require 'config/database.php';
require __DIR__ .'/../vendor/autoload.php';

//Conenectarnos a la base de datos
$db = conectarDB();

//Clase Padre
use Model\Place;
use Model\Dayl;
use Model\Dayll;
use Model\Space;
use Model\Cate_Place;
use Model\Entrepreneur;
use Model\Gastronomy;
use Model\Cate_Gastronomy;
use Model\Type_Gastronomy;
use Model\Activity;
use Model\Age;
use Model\State;
use Model\User;
use Model\Role;
use Model\Cate_Entrepreneur;
use Model\Product_entrepreneur;
use Model\Fair_Entrepreneur;
use Model\DaylGastronomie;
use Model\DayllGastronomie;
use Model\DayActivity;
use Model\Login;
use Model\StatePlace;

Place::setDB($db);
Dayl::setDB($db);
Dayll::setDB($db);
Space::setDB($db);
Cate_Place::setDB($db);
Entrepreneur::setDB($db);
Gastronomy::setDB($db);
Cate_Gastronomy::setDB($db);
Type_Gastronomy::setDB($db);
Activity::setDB($db);
Age::setDB($db);
State::setDB($db);
User::setDB($db);
Role::setDB($db);
Cate_Entrepreneur::setDB($db);
Product_entrepreneur::setDB($db);
Fair_Entrepreneur::setDB($db);
DaylGastronomie::setDB($db);
DayllGastronomie::setDB($db);
DayActivity::setDB($db);
Login::setDB($db);
StatePlace::setDB($db);
