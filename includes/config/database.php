<?php
function conectarBD()

{

    $cadena_conexion = 'mysql:dbname=dwes_t3;host=127.0.0.1';

    $usuario = "root";

    $clave = "";
 
    try {

        $bd = new PDO($cadena_conexion, $usuario, $clave);

        return $bd;

    } catch (PDOException $e) {

        echo "Error conectar BD: " . $e->getMessage();

        exit;

    }

}

$conn = conectarBD();
