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

// Tratar formulario
if (isset($_REQUEST['enviar'])) {
    $sql = "UPDATE Clubes SET nombre = ?, fundacion = ?, num_socios = ?, estadio = ? WHERE cif = ?";
    $sentPreparada = $conexion->prepare($sql);
    $sentPreparada->bind_param(
        "siiss",
        $_REQUEST['nombre'],
        $_REQUEST['fundacion'],
        $_REQUEST['num_socios'],
        $_REQUEST['estadio'],
        $_REQUEST['cif']
    );

    if ($sentPreparada->execute()) {
        $resultado = "Club Actualizado";
    } else {
        $resultado = "ERROR en la actualización";
    }
}

// Consultamos la tabla Clubes por CIF
$sql = "SELECT * FROM Clubes WHERE cif = ?";
$sentPreparada = $conexion->prepare($sql);
$sentPreparada->bind_param("s", $_REQUEST['cif']);
$sentPreparada->execute();
$tabla = $sentPreparada->get_result();
$registro = $tabla->fetch_all(MYSQLI_ASSOC);
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
            if (isset($_REQUEST['enviar'])) {
                echo $resultado;
            }
            ?>
        </p>
    </section>
    <form action="#" method="post" class="form">
        <fieldset class="w-50">
            <label for="cif" class="form-label">CIF</label>
            <input type="text" name="cif" id="cif" class="form-control" disabled="disabled"
                value="<?php echo $registro[0]['cif'] ?>"><br>
            <input type="hidden" name="cif" id="cif" class="form-control" value="<?php echo $registro[0]['cif'] ?>">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control"
                value="<?php echo $registro[0]['nombre'] ?>"><br>
            <label for="fundacion" class="form-label">Fundación</label>
            <input type="number" name="fundacion" id="fundacion" class="form-control"
                value="<?php echo $registro[0]['fundacion'] ?>" min="1900" max="2024"><br>
            <label for="num_socios" class="form-label">Nº Socios</label>
            <input type="number" name="num_socios" id="num_socios" class="form-control"
                value="<?php echo $registro[0]['num_socios'] ?>"><br>
            <label for="estadio" class="form-label">Estadio</label>
            <input type="text" name="estadio" id="estadio" class="form-control"
                value="<?php echo $registro[0]['estadio'] ?>"><br>
            <input type="submit" value="Actualizar" class="form-control" name="enviar">
        </fieldset>
    </form>

    <?php
    $conexion->close();
    ?>
</body>

</html>