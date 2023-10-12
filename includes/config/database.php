<?php 

function conectarDB() : mysqli {
    $db = new mysqli('localhost', 'root', 'Adminuser23', 'bioVet');

    if(!$db) {
        echo "Error no se pudo conectar";
        exit;
    } 

    return $db;
    
}