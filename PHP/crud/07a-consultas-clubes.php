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
    $cif = $_REQUEST['cif'];
    $resultado = "Datos Completos Partidos";

    $sql = "SELECT
    ClubesLocal.nombre AS ClubLocal,
    EntrenadoresLocal.nombre AS EntrenadorLocal,
    Partidos.goles_local AS Local,
    Partidos.goles_visitante AS Visitante,
    ClubesVisitante.nombre AS ClubVisitante,
    EntrenadoresVisitante.nombre AS EntrenadorVisitante,
    Partidos.fecha AS FechaPartido,
    Partidos.arbitro AS Arbitro
    FROM Partidos
    JOIN Clubes AS ClubesLocal ON Partidos.Clubes_cif_local = ClubesLocal.cif
    JOIN Entrenadores AS EntrenadoresLocal ON ClubesLocal.cif = EntrenadoresLocal.cif
    JOIN Clubes AS ClubesVisitante ON Partidos.Clubes_cif_visitante = ClubesVisitante.cif
    JOIN Entrenadores AS EntrenadoresVisitante ON ClubesVisitante.cif = EntrenadoresVisitante.cif
    WHERE Clubes_cif_local = ?";

    $sentPreparada = $conexion->prepare($sql);
    $sentPreparada->bind_param("s", $cif);
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
            <label for="cif" class="form-label">CIF Equipo local</label>
            <input type="text" name="cif" id="cif" class="form-control"><br>
            <input type="submit" value="Enviar" class="form-control" name="enviar">
        </fieldset>
    </form>
    <table class="table">
        <thead class="table-danger">
            <tr>
                <th>Club Local</th>
                <th>Entrenador Local</th>
                <th>Local</th>
                <th>Visitante</th>
                <th>Club Visitante</th>
                <th>Entrenador Visitante</th>
                <th>Fecha</th>
                <th>Arbitro</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_REQUEST['enviar'])) {
                foreach ($registros as $registro) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $registro['ClubLocal'] ?>
                        </td>
                        <td>
                            <?php echo $registro['EntrenadorLocal'] ?>
                        </td>
                        <td>
                            <?php echo $registro['Local'] ?>
                        </td>
                        <td>
                            <?php echo $registro['Visitante'] ?>
                        </td>
                        <td>
                            <?php echo $registro['ClubVisitante'] ?>
                        </td>
                        <td>
                            <?php echo $registro['EntrenadorVisitante'] ?>
                        </td>
                        <td>
                            <?php echo $registro['FechaPartido'] ?>
                        </td>
                        <td>
                            <?php echo $registro['Arbitro'] ?>
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