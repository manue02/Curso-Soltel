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

// Tratar formulario
if (isset($_REQUEST['enviar'])) {
    $resultado = "Datos Completos Entrenadores";

    $sql = "SELECT * FROM Entrenadores";

    $sentPreparada = $conexion->prepare($sql);
    $sentPreparada->execute();
    $tabla = $sentPreparada->get_result();
    $registros = $tabla->fetch_all(MYSQLI_ASSOC);
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
            <input type="submit" value="Ver Entrenadores" class="form-control" name="enviar"><br>
        </fieldset>
    </form>
    <table class="table">
        <thead class="table-danger">
            <tr>
                <th>nif_nie</th>
                <th>Entrenador</th>
                <th>edad</th>
                <th>destituido</th>
                <th>Ficha mensual</th>
                <th>CIF Club</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_REQUEST['enviar'])) {
                foreach ($registros as $registro) {
                    if ($registro['destituido']) {
                        $destituido = "SI";
                    } else {
                        $destituido = "NO";
                    }
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
                            <?php echo $destituido ?>
                        </td>
                        <td>
                            <?php echo $registro['ficha'] ?> Euros
                        </td>
                        <td>
                            <?php echo $registro['cif'] ?>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>

    </table>
    <?php
    $conexion->close();
    ?>
</body>

</html>