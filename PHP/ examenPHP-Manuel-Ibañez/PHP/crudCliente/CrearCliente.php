<?php
require("../funciones.php");
ErroresVendor();
session_start();

NuevoCliente($_REQUEST['nif'], $_REQUEST['nombre'], $_REQUEST['direccion'], $_REQUEST['telefono'], true, $_REQUEST['fecha_alta']);

function NuevoCliente($nif, $nombre, $direccion, $telefono, $activo, $fecha_alta)
{
    $conexion = conectarBBDD("localhost", "root", "root", "Hyundai");

    $sentencia = $conexion->prepare("INSERT INTO Cliente (nif, nombre, direccion, telefono, Activo, fecha_alta) VALUES (?, ?, ?, ?, ?, ?)");
    $sentencia->bind_param("ssssis", $nif, $nombre, $direccion, $telefono, $activo, $fecha_alta);

    if ($sentencia->execute()) {
        header("Location: listarCliente.php");
    } else {
        echo "Error: " . $sentencia->error;
    }

    $sentencia->close();
    $conexion->close();
}