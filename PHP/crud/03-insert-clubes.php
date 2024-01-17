<?php
// declare(strict_types=1);
require '../../vendor/autoload.php';

$whoops = new Whoops\Run();
$whoops->pushHandler(new Whoops\Handler\PrettyPageHandler());
$whoops->register();
require("funciones.php")
    ?>
<?php

// Objeto conexión
$conexion = conectarBBDD();

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
    $mensajeSesion = "Usuario: " . $_SESSION['usuario'];
}


// Tratar formulario
if (isset($_REQUEST['enviar'])) {
    $cif = $_REQUEST['cif'];
    $nombre = $_REQUEST['nombre'];
    $fundacion = $_REQUEST['fundacion'];
    $numsocios = $_REQUEST['numsocios'];
    $estadio = $_REQUEST['estadio'];
    //echo $cif . "<br>";

    // Defino la sentencia preparada
    $sql = "INSERT INTO Clubes 
            (cif, nombre, fundacion, num_socios, estadio, activo)
            VALUES (?, ?, ?, ?, ?, 1)";
    $stmt = $conexion->prepare($sql);
    // Vinculo los parámetros
    // - s -> char, varchar
    // - i -> int, boolean
    // - d -> decimal, flotante
    $stmt->bind_param("ssiis", $cif, $nombre, $fundacion, $numsocios, $estadio);

    // Ejecuto la consulta y compruebo
    if ($stmt->execute()) {
        $resultado = "Registro insertado correctamente";
    } else {
        $resultado = "ERROR en la inserción";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="p-3 m-2 border-0 bd-example">
    <section aria-label="info">
        <p class="alert alert-info w-50">
            <?php
            echo $mensajeSesion;
            if (isset($_REQUEST['enviar'])) {
                echo $resultado;
            }
            ?>
        </p>
    </section>
    <form action="#" method="post" class="form">
        <fieldset class="w-50">
            <label for="cif" class="form-label">CIF</label>
            <input type="text" name="cif" id="cif" class="form-control" maxlength="9"><br>
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control"><br>
            <label for="fundacion" class="form-label">Fundación</label>
            <input type="number" name="fundacion" id="fundacion" class="form-control" min="1900" max="2155"><br>
            <label for="numsocios" class="form-label">Nº Socios</label>
            <input type="number" name="numsocios" id="numsocios" class="form-control" min="1"><br>
            <label for="estadio" class="form-label">Estadio</label>
            <input type="text" name="estadio" id="estadio" class="form-control"><br>
            <input type="submit" value="Enviar" class="form-control" name="enviar"><br>
            <input type="submit" value="Salir" class="form-control" name="salir"><br>
        </fieldset>
    </form>
    <p>
        <a href="02-login.php">Login</a> <br>
        <a href="03-insert-clubes.php">Insertar</a> <br>
        <a href="04-select-clubes.php">Consultar</a><br>
        <a href="05-update-clubes.php">Actualizar</a><br>
        <a href="06-delete-entrenadores.php">Borrar</a><br>
        <br>
        <a href="07a-consultas-clubes.php">Ver Partidos por Club Local</a><br>
        <a href="07b-consultas-clubes.php">Ver Jugadores por Club y Posición</a><br>
        <a href="07c-entrenadores-clubes.php">Ver Entrenadores</a><br>
    </p>
    <?php
    $conexion->close();
    ?>
</body>

</html>