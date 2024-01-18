<?php
require("../funciones.php");
ErroresVendor();
session_start();

EliminarCliente($_REQUEST['nif']);

function eliminarCliente($nif)
{
    $conexion = new mysqli("localhost", "root", "root", "Hyundai");

    if ($conexion->connect_error) {
        die("Connection failed: " . $conexion->connect_error);
    }

    $sentencia = $conexion->prepare("UPDATE Cliente SET activo = 0 WHERE nif = ?");
    $sentencia->bind_param("s", $nif);

    if ($sentencia->execute()) {
        header("Location: listarCliente.php");
    } else {
        echo "Error: " . $sentencia->error;
    }

    $sentencia->close();
    $conexion->close();
}