<?php

function conectarBBDD($servidor, $usuario, $clave, $bbdd)
{
    // Objeto conexión
    $conexion = new mysqli($servidor, $usuario, $clave, $bbdd);
    // Comprobamos la conexión
    if ($conexion->connect_error) {
        die("Error de Conexión: " . $conexion->connect_error);
    }
    /*
    else {
        echo "Conexión correcta";
    }*/

    return $conexion;
}

function ErroresVendor()
{
    require '../../vendor/autoload.php';

    $whoops = new Whoops\Run();
    $whoops->pushHandler(new Whoops\Handler\PrettyPageHandler());
    $whoops->register();
}