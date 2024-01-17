<?php
// declare(strict_types=1);
require '../../vendor/autoload.php';

$whoops = new Whoops\Run();
$whoops->pushHandler(new Whoops\Handler\PrettyPageHandler());
$whoops->register();
require("funciones.php")
    ?>
<?php
// Compruebo sesión
$mensajeSesion = sesion();

// Objeto conexión 
$conexion = conectarBBDD();
$resultado = "";
// Tratar formulario (Borrado FISICO)
if (isset($_REQUEST['borrar'])) {
    // MODO VIRGUERO (MODULARIZANDO con funciones)
    $resultado = borrarRegistro("Entrenadores", $conexion, "nif_nie", $_REQUEST['nif_nie'], "s");

    // MODO NO VIRGUERO
    /*
    $sql = "DELETE FROM Clubes WHERE cif = ?";
    $sentPreparada = $conexion->prepare($sql);
    $sentPreparada->bind_param("s", $_REQUEST['cif']);
    if ($sentPreparada->execute()) {
        $resultado = "Borrado FISICO correcto";
    } else {
        $resultado = "ERROR en el DELETE";
    }
    */
}

if (isset($_REQUEST['logico'])) {
    // MODO VIRGUERO (MODULARIZANDO con funciones)
    //$resultado = borradoLogico("Entrenadores", $conexion, "nif_nie", $_REQUEST['nif_nie'], "s", "destituido");

    // MODO NO VIRGUERO
    $sql = "UPDATE Entrenadores SET destituido = 1 WHERE nif_nie = ?";
    $sentPreparada = $conexion->prepare($sql);
    $sentPreparada->bind_param("s", $_REQUEST['nif_nie']);
    if ($sentPreparada->execute()) {
        $resultado = "Borrado Lógico correcto";
    } else {
        $resultado = "ERROR en el BORRADO";
    }
}

// Consulta Tabla
$registros = consultarTabla("Entrenadores", $conexion);
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

            if (isset($_REQUEST['fisico']) || isset($_REQUEST['logico'])) {
                echo $resultado;
            }
            ?>
        </p>
    </section>
    <table class="table table-striped table-hover">
        <thead class="table-primary">
            <tr>
                <th>NIF/NIE</th>
                <th>Nombre</th>
                <th>Edad</th>
                <th>Ficha</th>
                <th>CIF</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($registros as $registro) {
                ?>
                <tr>
                    <td>
                        <?php echo $registro['nif_nie'] ?>
                    </td>
                    <td>
                        <?php echo $registro['nombre'] ?>
                    </td>
                    <td>
                        <?php echo $registro['edad'] ?>
                    </td>
                    <td>
                        <?php echo $registro['ficha'] ?> Euros
                    </td>
                    <td>
                        <?php echo $registro['cif'] ?>
                    </td>
                    <td>
                        <form action="#" method="get">
                            <input type="hidden" name="nif_nie" value="<?php echo $registro['nif_nie'] ?>">
                            <input type="submit" value="Borrado Fisico" name="fisico">
                        </form>
                    </td>
                    <td>
                        <form action="#" method="get">
                            <input type="hidden" name="nif_nie" value="<?php echo $registro['nif_nie'] ?>">
                            <input type="submit" value="Borrado Lógico" name="logico">
                        </form>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <?php
    if (isset($_REQUEST['fisico'])) {
        ?>
        <form action="#" method="get" class="form">
            <p> ¿Deseas borrar? </p>
            <input type="hidden" name="nif_nie" value="<?php echo $_REQUEST['nif_nie'] ?>">
            <input type="submit" value="si" name="borrar" class="form-control"><br>
            <input type="submit" value="no" class="form-control"><br>
        </form>
        <?php
    }
    ?>
    <form action="#" method="post">
        <input type="submit" value="Salir" class="form-control" name="salir"><br>
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

    ?>
</body>

</html>