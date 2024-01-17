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

// Realizo la consulta completa a la BBDD
$sql = "SELECT * FROM Clubes ORDER BY nombre";
$tabla = $conexion->query($sql);
$num_filas = $tabla->num_rows;
$registros = $tabla->fetch_all(MYSQLI_ASSOC);

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
            echo "Filas tabla: $num_filas";
            ?>
        </p>
    </section>
    <table class="table table-striped table-hover">
        <thead class="table-primary">
            <tr>
                <th>CIF</th>
                <th>Nombre</th>
                <th>Fundación</th>
                <th>Nº Socios</th>
                <th>Estadio</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($registros as $registro) {
                ?>
                <tr>
                    <td>
                        <?php echo $registro['cif'] ?>
                    </td>
                    <td>
                        <?php echo $registro['nombre'] ?>
                    </td>
                    <td>
                        <?php echo $registro['fundacion'] ?>
                    </td>
                    <td>
                        <?php echo $registro['num_socios'] ?>
                    </td>
                    <td>
                        <?php echo $registro['estadio'] ?>
                    </td>
                    <td>
                        <form action="05b-update-clubes.php" method="post">
                            <input type="hidden" name="cif" value="<?php echo $registro['cif'] ?>">
                            <input type="submit" value="Ver">
                        </form>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>

    <?php
    $conexion->close();
    ?>
</body>

</html>