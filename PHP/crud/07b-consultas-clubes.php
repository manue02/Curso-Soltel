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

// Voy a cargar COMBOS NombreClunes y Posiciones
// Añado saneamiento
$sqlPosiciones = "SELECT * FROM Posiciones";
$sentPosiciones = $conexion->prepare($sqlPosiciones);
$sentPosiciones->execute();
$registrosPosiciones = $sentPosiciones->get_result();

$sqlClubes = "SELECT * FROM Clubes";
$sentClubes = $conexion->prepare($sqlClubes);
$sentClubes->execute();
$registrosClubes = $sentClubes->get_result();

// Tratar formulario
if (isset($_REQUEST['enviar'])) {
    $cif = $_REQUEST['clubes'];
    $posicion = $_REQUEST['posiciones'];
    $resultado = "Datos Completos Jugadores por posición y club";

    $sql = "SELECT Clubes.nombre as Club,
            Jugadores.nombre as Jugador,
            posicion as Posicion
            FROM Clubes, Posiciones, Jugadores
            WHERE Clubes.cif = Jugadores.cif
            AND Posiciones.idPosicion = Jugadores.idPosicion
            AND Posiciones.idPosicion = ?
            AND Clubes.cif = ?";

    $sentPreparada = $conexion->prepare($sql);
    $sentPreparada->bind_param("is", $posicion, $cif);
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
            <label for="posiciones" class="form-label">Posiciones</label>
            <select name="posiciones" id="posiciones" class="form-select">
                <?php
                while ($registro = $registrosPosiciones->fetch_assoc()) {
                    ?>
                    <option value="<?php echo $registro['idPosicion'] ?>">
                        <?php echo $registro['posicion'] ?>
                    </option>
                    <?php
                }
                ?>
            </select><br>
            <select name="clubes" id="clubes" class="form-select">
                <?php
                while ($registro = $registrosClubes->fetch_assoc()) {
                    ?>
                    <option value="<?php echo $registro['cif'] ?>">
                        <?php echo $registro['nombre'] ?>
                    </option>
                    <?php
                }
                ?>
            </select><br>
            <input type="submit" value="Enviar" class="form-control" name="enviar"><br>
        </fieldset>
    </form>
    <table class="table">
        <thead class="table-danger">
            <tr>
                <th>Club</th>
                <th>Jugador</th>
                <th>Posicion</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_REQUEST['enviar'])) {
                foreach ($registros as $registro) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $registro['Club'] ?>
                        </td>
                        <td>
                            <?php echo $registro['Jugador'] ?>
                        </td>
                        <td>
                            <?php echo $registro['Posicion'] ?>
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