<?php

function conectarBBDD($servidor, $usuario, $clave, $bbdd)
{
    // Objeto conexión
    $conexion = new mysqli($servidor, $usuario, $clave, $bbdd);
    // Comprobamos la conexión
    if ($conexion->connect_error) {
        die("Error de Conexión: " . $conexion->connect_error);
    }

    return $conexion;
}

function ErroresVendor()
{
    ini_set('display_errors', 1); // Muestra los errores en la pantalla
    ini_set('display_startup_errors', 1); // Muestra los errores de inicio
    error_reporting(E_ALL); // Reporta todos los errores de PHP
}

foreach ($x as $plantilla) {
    echo "<pre>";
    print_r($plantilla);
    echo "</pre>";
}