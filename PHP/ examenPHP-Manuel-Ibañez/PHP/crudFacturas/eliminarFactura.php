<?php
require("../funciones.php");
ErroresVendor();
session_start();

EliminarFactura($_REQUEST['numero_factura']);

function EliminarFactura($numero_factura)
{
    $conexion = new mysqli("localhost", "root", "root", "Hyundai");

    if ($conexion->connect_error) {
        die("Connection failed: " . $conexion->connect_error);
    }

    $sentencia = $conexion->prepare("UPDATE Factura SET activo = 0 WHERE numero_factura = ?");
    $sentencia->bind_param("s", $numero_factura);

    if ($sentencia->execute()) {
        header("Location: listarFactura.php");
    } else {
        echo "Error: " . $sentencia->error;
    }

    $sentencia->close();
    $conexion->close();
}