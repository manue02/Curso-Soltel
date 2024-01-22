<?php
require("../funciones.php");
ErroresVendor();
session_start();

NuevoCoche($_REQUEST['matricula'], $_REQUEST['modelo'], $_REQUEST['ano_fabricacion'], $_REQUEST['tipo_combustible'], $_REQUEST['precio'], $_REQUEST['color']);

function NuevoCoche($matricula, $modelo, $ano_fabricacion, $tipo_combustible, $precio, $color)
{
    $conexion = conectarBBDD("localhost", "root", "root", "Hyundai");

    $sentencia = $conexion->prepare("INSERT INTO Coche (matricula, modelo, ano_fabricacion, tipo_combustible, precio, color) VALUES (?, ?, ?, ?, ?, ?)");
    $sentencia->bind_param("ssssis", $matricula, $modelo, $ano_fabricacion, $tipo_combustible, $precio, $color);

    if ($sentencia->execute()) {
        header("Location: listarCoche.php");
    } else {
        echo "Error: " . $sentencia->error;
    }

    $sentencia->close();
    $conexion->close();
}