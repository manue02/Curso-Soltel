<?php

// 1. Función para devolver objeto conexión a BBDD
function conectarBBDD()
{
    /* Conexión con la BBDD LaLiga */
    $servidor = "localhost";
    $usuario = "root";
    $clave = "root";
    $bbdd = "LaLiga";

    // Objeto conexión
    $conexion = new mysqli($servidor, $usuario, $clave, $bbdd);
    // Comprobamos la conexión
    if ($conexion->connect_error) {
        die("Error de Conexión: " . $conexion->connect_error);
    }
    /*
    else {
        echo "Conexión correcta";
    }*/

    return $conexion;
}

// 2. Función que devuelve los registros de una tabla
function consultarTabla($nombreTabla, $conexion)
{
    $sql = "SELECT * FROM $nombreTabla";
    $tabla = $conexion->query($sql);
    $registros = $tabla->fetch_all(MYSQLI_ASSOC);
    return $registros;
}

// 3. Función para borrado físico
function borrarRegistro($nombreTabla, $conexion, $pk, $valorPK, $vinculo)
{
    $sql = "DELETE FROM $nombreTabla WHERE $pk = ?";
    $sentPreparada = $conexion->prepare($sql);
    $sentPreparada->bind_param($vinculo, $valorPK);
    if ($sentPreparada->execute()) {
        return "Actualización correcta";
    } else {
        return "ERROR en el DELETE";
    }
}

// 4. Función para borrado lógico
function borradoLogico($nombreTabla, $conexion, $pk, $valorPK, $vinculo)
{
    $sql = "UPDATE $nombreTabla SET activo = 0 WHERE $pk = ?";
    $sentPreparada = $conexion->prepare($sql);
    $sentPreparada->bind_param($vinculo, $valorPK);
    if ($sentPreparada->execute()) {
        return "Borrado Lógico correcto";
    } else {
        return "ERROR en el BORRADO";
    }
}

// 5. Función sesion
function sesion()
{
    // Sesiones
    session_start();

    // Salir de la sesión
    if (isset($_REQUEST['salir'])) {
        session_destroy();
        header("Location: 02-login.php");
        exit();
    }

    // Comprobar que estoy logado
    if ($_SESSION['usuario'] != "admin") {
        header("Location: 02-login.php");
        exit();
    } else {
        return "Usuario: " . $_SESSION['usuario'] . "<br>";
    }
}
