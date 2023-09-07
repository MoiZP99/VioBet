<?php 

function conectarDB() : mysqli {
    $db = new mysqli('localhost', 'root', 'Dell*2730mzp', 'somoshojancha');

    if(!$db) {
        echo "Error no se pudo conectar";
        exit;
    } 

    return $db;
    
}