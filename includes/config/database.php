<?php 

function conectarDB() : mysqli {
    $db = new mysqli('localhost', 'root', '0218JS', 'biovet');

    if(!$db) {
        echo "Error no se pudo conectar";
        exit;
    } 

    return $db;
    
}