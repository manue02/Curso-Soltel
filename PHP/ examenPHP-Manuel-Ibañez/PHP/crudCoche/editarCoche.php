<?php
require("../funciones.php");
ErroresVendor();
session_start();

EditarCoche($_REQUEST['matricula'], $_REQUEST['modelo'], $_REQUEST['ano_fabricacion'], $_REQUEST['tipo_combustible'], $_REQUEST['precio'], $_REQUEST['color']);

function EditarCoche($matricula, $modelo, $ano_fabricacion, $tipo_combustible, $precio, $color)
{
    $conexion = conectarBBDD("localhost", "root", "root", "Hyundai");

    $sentencia = $conexion->prepare("UPDATE Coche SET modelo = ?, ano_fabricacion = ?, tipo_combustible = ?, precio = ?, color = ? WHERE matricula = ?");
    $sentencia->bind_param("ssssss", $modelo, $ano_fabricacion, $tipo_combustible, $precio, $color, $matricula);

    if ($sentencia->execute()) {
        header("Location: listarCoche.php");
    } else {
        echo "Error: " . $sentencia->error;
    }

    $sentencia->close();
    $conexion->close();
}