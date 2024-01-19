<?php
require("../funciones.php");
ErroresVendor();
session_start();

NuevoEmpleado($_REQUEST['nif'], $_REQUEST['nombre'], $_REQUEST['fecha_contratacion'], $_REQUEST['salario'], $_REQUEST['telefono'], true);

function NuevoEmpleado($nif, $nombre, $fecha_contratacion, $salario, $telefono, $activo)
{
    $conexion = conectarBBDD("localhost", "root", "root", "Hyundai");

    $sentencia = $conexion->prepare("INSERT INTO Empleado (nif, nombre, fecha_contratacion, salario, telefono, Activo) VALUES (?, ?, ?, ?, ?, ?)");
    $sentencia->bind_param("ssssis", $nif, $nombre, $fecha_contratacion, $salario, $telefono, $activo);

    if ($sentencia->execute()) {
        header("Location: listarEmpleado.php");
    } else {
        echo "Error: " . $sentencia->error;
    }

    $sentencia->close();
    $conexion->close();
}