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


// Zona de Consulta
// -----------------------------------------------------------------
$sql = "SELECT * FROM Clubes";
$registros = $conexion->query($sql);

// Vemos si la tabla está vacia
$num_registros = $registros->num_rows;  // Propiedad
if ($num_registros > 0) {
    $resultado = "Encontrado/s $num_registros Registro/s";
} else {
    $resultado = "Tabla Vacia";
}
// -----------------------------------------------------------------

// Zona de Actualización
// -----------------------------------------------------------------
if (isset($_REQUEST['actualizar'])) {
    $cif = $_REQUEST['cif'];
    $nombre = $_REQUEST['nombre'];
    $fundacion = $_REQUEST['fundacion'];
    $numsocios = $_REQUEST['numsocios'];
    $estadio = $_REQUEST['estadio'];

    $sqlUpdate = "UPDATE Clubes 
                SET nombre=?, 
                fundacion=?, 
                num_socios=?, 
                estadio=? 
                WHERE cif=?";
    $sentenciaSQL = $conexion->prepare($sqlUpdate);
    $sentenciaSQL->bind_param("siiss", $nombre, $fundacion, $numsocios, $estadio, $cif);

    if ($sentenciaSQL->execute()) {
        $resultado .= "<br> Registro actualizado correctamente";
    } else {
        $resultado .= "<br> ERROR en la actualización";
    }
}
// -----------------------------------------------------------------


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

    <!-- Parte Consulta -->
    <section>
        <table class="table table-striped table-hover">
            <thead class="table-primary">
                <tr>
                    <th>CIF</th>
                    <th>Nombre</th>
                    <th>Año Fundación</th>
                    <th>Nº Socios</th>
                    <th>Estadio</th>
                    <th></th>
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
                    ?>
                    <td>
                        <form action="#" method="get">
                            <input type="hidden" name="cif" value="<?php echo $registro['cif']; ?>">
                            <input type="submit" name="ver" value="Ver">
                        </form>
                    </td>
                    <?php
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </section>

    <!-- Parte Formulario Actualizacion -->
    <section aria-label="formulario">
        <?php
        if (isset($_REQUEST['ver'])) {
            /*
            $sql = "SELECT * FROM Clubes WHERE cif = ?";
            $sentenciaSQL = $conexion->prepare($sql);
            $sentenciaSQL->bind_param("s", $_REQUEST['cif']);
            $sentenciaSQL->execute();
            $tabla = $sentenciaSQL->get_result();
            $registros = $tabla->fetch_all(MYSQLI_ASSOC);
            */

            // MODO VIRGUERO: CUIDADO!
            $sentenciaSQL = $conexion->prepare("SELECT * FROM Clubes WHERE cif = ?");
            $sentenciaSQL->bind_param("s", $_REQUEST['cif']);
            $sentenciaSQL->execute();
            $registros = $sentenciaSQL->get_result()->fetch_all(MYSQLI_ASSOC);

            foreach ($registros as $registro) {
                ?>
                <form action="#" method="post" class="form">
                    <fieldset class="w-50">
                        <label for="cif" class="form-label">CIF</label>
                        <input type="text" name="cif" id="cif" class="form-control" maxlength="9"
                            value="<?php echo $registro['cif'] ?>" disabled="disabled"><br>
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control"
                            value="<?php echo $registro['nombre'] ?>"><br>
                        <label for="fundacion" class="form-label">Fundación</label>
                        <input type="number" name="fundacion" id="fundacion" class="form-control" min="1900" max="2155"
                            value="<?php echo $registro['fundacion'] ?>"><br>
                        <label for="numsocios" class="form-label">Nº Socios</label>
                        <input type="number" name="numsocios" id="numsocios" class="form-control" min="1"
                            value="<?php echo $registro['num_socios'] ?>"><br>
                        <label for="estadio" class="form-label">Estadio</label>
                        <input type="text" name="estadio" id="estadio" class="form-control"
                            value="<?php echo $registro['estadio'] ?>"><br>
                        <input type="submit" value="Actualizar" class="form-control" name="actualizar">
                    </fieldset>
                </form>
                <?php
            }
        }
        ?>
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