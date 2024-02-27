<?php 

function conectarDB() : mysqli {
    $db = mysqli_connect('localhost', 'root', 'root', 'panaderia', 3307);

    if(!$db) {
        echo "Error no se pudo conectar a la bbdd";
        exit;
    } 
    return $db;
}