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
// $conexion = conectarBBDD();

// Sesiones
session_start();

// Tratar formulario
if (isset($_REQUEST['enviar'])) {
    $usuario = $_REQUEST['usuario'];
    $clave = $_REQUEST['clave'];

    if ($usuario == "admin" && $clave == 1234) {
        $_SESSION['usuario'] = $usuario;
        header("Location: 03-insert-clubes.php");
        exit();
    } else {
        header("Location: 02-login.php");
        exit();
    }
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
            Formulario de entrada
        </p>
    </section>
    <form action="#" method="post" class="form">
        <fieldset class="w-50">
            <label for="usuario" class="form-label">Usuario</label>
            <input type="text" name="usuario" id="usuario" class="form-control"><br>
            <label for="clave" class="form-label">Contraseña</label>
            <input type="password" name="clave" id="clave" class="form-control"><br>
            <input type="submit" value="Entrar" class="form-control" name="enviar">
        </fieldset>
    </form>
    <p>
        <a href="02-login.php">Login</a> <br>
        <a href="03-insert-clubes.php">Insertar</a> <br>
        <a href="04-select-clubes.php">Consultar</a><br>
        <a href="05-update-clubes.php">Actualizar</a><br>
        <a href="06-delete-clubes.php">Borrar</a><br>
    </p>

    <?php
    //$conexion->close();
    ?>
</body>

</html>