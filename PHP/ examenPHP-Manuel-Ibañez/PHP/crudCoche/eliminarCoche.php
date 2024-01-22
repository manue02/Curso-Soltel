<?php
require("../funciones.php");
ErroresVendor();
session_start();

EliminarCoche($_REQUEST['matricula']);

function EliminarCoche($matricula)
{
    $conexion = new mysqli("localhost", "root", "root", "Hyundai");

    if ($conexion->connect_error) {
        die("Connection failed: " . $conexion->connect_error);
    }

    $borrarFactura = $conexion->prepare("DELETE FROM Factura WHERE matricula_coche_comprado = ?");
    $borrarFactura->bind_param("s", $matricula);

    if ($borrarFactura->execute()) {
        $sentencia = $conexion->prepare("DELETE FROM Coche WHERE matricula = ?");
        $sentencia->bind_param("s", $matricula);

        if ($sentencia->execute()) {
            header("Location: listarCoche.php");
        } else {
            echo "Error: " . $sentencia->error;
        }
        $sentencia->close();

    } else {
        echo "Error: " . $borrarFactura->error;
    }




    $borrarFactura->close();
    $conexion->close();
}