<?php 

function conectarDB() : mysqli {
    $db = mysqli_connect('localhost', 'root', '', 'panaderia');

    if(!$db) {
        echo "Error no se pudo conectar a la bbdd";
        exit;
    } 
    return $db;
    
}