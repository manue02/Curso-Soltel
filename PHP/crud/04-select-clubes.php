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

// SELECT
$sql = "SELECT * FROM Clubes";
$registros = $conexion->query($sql);

// Vemos si la tabla está vacia
$num_registros = $registros->num_rows;  // Propiedad
if ($num_registros > 0) {
    $resultado = "Encontrado/s $num_registros Registro/s";
} else {
    $resultado = "Tabla Vacia";
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
            echo $resultado;
            ?>
        </p>
    </section>

    <!-- 1ª forna: Campos sin personalizar y celdas completas -->
    <section aria-label="tabla">
        <table class="table table-striped table-hover">
            <thead class="table-primary">
                <tr>
                    <?php
                    $campos = $registros->fetch_assoc();
                    foreach ($campos as $campo => $valor) {
                        echo "<th> $campo </th>";
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $registros = $conexion->query($sql);
                while ($registro = $registros->fetch_assoc()) {
                    echo "<tr>";
                    foreach ($registro as $celda) {
                        echo "<td>  $celda </td>";
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </section>

    <!-- 2ª forna: Campos y celdas personalizados -->
    <section>
        <table class="table table-striped table-hover">
            <thead class="table-primary">
                <tr>
                    <th>CIF</th>
                    <th>Nombre</th>
                    <th>Año Fundación</th>
                    <th>Nº Socios</th>
                    <th>Estadio</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $tabla = $conexion->query($sql);
                $registros = $tabla->fetch_all(MYSQLI_ASSOC);
                foreach ($registros as $registro) {
                    echo "<tr>";
                    echo "<td>" . $registro['cif'] . "</td>";
                    echo "<td>" . $registro['nombre'] . "</td>";
                    echo "<td>" . $registro['fundacion'] . "</td>";
                    echo "<td>" . $registro['num_socios'] . "</td>";
                    echo "<td>" . $registro['estadio'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </section>

    <!-- 3ª forna: Campos personalizados y celdas completas -->
    <section>
        <table class="table table-striped table-hover">
            <thead class="table-primary">
                <tr>
                    <th>CIF</th>
                    <th>Nombre</th>
                    <th>Año Fundación</th>
                    <th>Nº Socios</th>
                    <th>Estadio</th>
                    <th>Activo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $registros = $conexion->query($sql);
                while ($registro = $registros->fetch_assoc()) {
                    echo "<tr>";
                    foreach ($registro as $celda) {
                        echo "<td>  $celda </td>";
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </section>
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
    $conexion->close();
    ?>
</body>

</html>