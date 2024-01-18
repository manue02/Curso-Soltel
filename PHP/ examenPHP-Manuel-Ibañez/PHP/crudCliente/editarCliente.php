<?php
require("../funciones.php");
ErroresVendor();
session_start();

editarCliente($_REQUEST['nif'], $_REQUEST['nombre'], $_REQUEST['direccion'], $_REQUEST['telefono'], $_REQUEST['fecha_alta'], $_REQUEST['activo']);

function editarCliente($nif, $nombre, $direccion, $telefono, $fecha_alta, $activo)
{
    $conexion = conectarBBDD("localhost", "root", "root", "Hyundai");

    $sentencia = $conexion->prepare("UPDATE Cliente SET nombre = ?, direccion = ?, telefono = ?, fecha_alta = ?, Activo = ? WHERE nif = ?");
    $sentencia->bind_param("ssssis", $nombre, $direccion, $telefono, $fecha_alta, $activo, $nif);

    if ($sentencia->execute()) {
        header("Location: listarCliente.php");
    } else {
        echo "Error: " . $sentencia->error;
    }

    $sentencia->close();
    $conexion->close();
}