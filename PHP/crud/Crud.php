<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud basico PHP</title>
    <link rel="stylesheet" href="../../HTML/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../../HTML/bootstrap/docs.css">
    <script src="../../HTML/bootstrap/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style></style>
</head>

<?php

require '../../vendor/autoload.php';

$whoops = new Whoops\Run();
$whoops->pushHandler(new Whoops\Handler\PrettyPageHandler());
$whoops->register();

$host = "localhost";
$user = "root";
$password = "root";
$database = "LaLiga.sql";

$conexion = mysqli_connect($host, $user, $password);

?>

<body class="p-3 m-2 border-0 bd-example">
    <section aria-label="info">
        <p class="alert alert-info w-50">
            <?php

            if ($conexion->connect_errno) {
                echo "Fallo al conectar a MySQL: (" . $conexion->connect_errno . ") " . $conexion->connect_error;
            } else {
                echo "Conectado a la base de datos";
            }

            if (isset($_REQUEST["enviar"])) {

                $ContenidoSql = file_get_contents("LaLiga.sql");
                $cargar = $conexion->multi_query($ContenidoSql);

                if ($cargar === TRUE) {
                    echo "Base de datos creada correctamente";
                } else {
                    echo "Error al crear la base de datos: " . $conexion->error;
                }
            }

            ?>
        </p>
    </section>
    <form action="#" method="post" class="form">
        <fieldset class="w-50">
            <input type="submit" value="Enviar" class="form-control" name="enviar">
        </fieldset>
    </form>



</body>

</html>