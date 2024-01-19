<?php
require("../funciones.php");
ErroresVendor();
session_start();

recuperarCliente($_REQUEST['nif']);

echo $_REQUEST['nif'];

function recuperarCliente($nif)
{
    $conexion = new mysqli("localhost", "root", "root", "Hyundai");

    if ($conexion->connect_error) {
        die("Connection failed: " . $conexion->connect_error);
    }

    $sentencia = $conexion->prepare("UPDATE Empleado SET activo = 1 WHERE nif = ?");
    $sentencia->bind_param("s", $nif);

    if ($sentencia->execute()) {
        header("Location: listarEmpleado.php");
    } else {
        echo "Error: " . $sentencia->error;
    }

    $sentencia->close();
    $conexion->close();
}