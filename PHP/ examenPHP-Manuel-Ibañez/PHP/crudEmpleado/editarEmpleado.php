<?php
require("../funciones.php");
ErroresVendor();
session_start();

EditarEmpleado($_REQUEST['nif'], $_REQUEST['nombre'], $_REQUEST['fecha_contratacion'], $_REQUEST['salario'], $_REQUEST['telefono'], $_REQUEST['activo']);

function EditarEmpleado($nif, $nombre, $fecha_contratacion, $salario, $telefono, $activo)
{
    $conexion = conectarBBDD("localhost", "root", "root", "Hyundai");

    $sentencia = $conexion->prepare("UPDATE Empleado SET nombre = ?, fecha_contratacion = ?, salario = ?, telefono = ?, Activo = ? WHERE nif = ?");
    $sentencia->bind_param("ssssis", $nombre, $fecha_contratacion, $salario, $telefono, $activo, $nif);

    if ($sentencia->execute()) {
        header("Location: listarEmpleado.php");
    } else {
        echo "Error: " . $sentencia->error;
    }

    $sentencia->close();
    $conexion->close();
}