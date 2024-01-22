<?php
require("../funciones.php");
ErroresVendor();
session_start();

NuevaFactura($_REQUEST['nif_empleado'], $_REQUEST['fecha_factura'], $_REQUEST['nif_cliente'], $_REQUEST['matricula'], $_REQUEST['total'], true);

function NuevaFactura($nif_empleado, $fecha_factura, $nif_cliente, $matricula, $total, $activo)
{
    $conexion = conectarBBDD("localhost", "root", "root", "Hyundai");

    $sentencia = $conexion->prepare("INSERT INTO Factura (nif_vendedor, fecha, nif_cliente, matricula_coche_comprado, total, activo) VALUES (?, ?, ?, ?, ?, ?)");
    $sentencia->bind_param("ssssss", $nif_empleado, $fecha_factura, $nif_cliente, $matricula, $total, $activo);



    if ($sentencia->execute()) {
        header("Location: listarFactura.php");
    } else {
        echo "Error: " . $sentencia->error;
    }

    $sentencia->close();
    $conexion->close();
}