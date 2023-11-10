<?php 

function conectarDB() : mysqli {
    $db = new mysqli('localhost', 'root', 'Dell*2730mzp', 'biovet');

    if(!$db) {
        echo "Error no se pudo conectar";
        exit;
    } 

    return $db;
    
}