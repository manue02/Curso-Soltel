<?php

require '../../vendor/autoload.php';

$whoops = new Whoops\Run();
$whoops->pushHandler(new Whoops\Handler\PrettyPageHandler());
$whoops->register();

// Se pide al usuario por formulario los siguientes campos: A (área base), h (Altura) y r (radio). Controla que el valor del campo se
// envía para el cálculo (por ejemplo, el prisma NO necesita el radio; el usuario NO enviará este dato y se debe evitar el error).
// Añadir el campo opción. Los valores permitidos son del 1 al 4. Cualquier otro número mostrará el mensaje “Opción
// incorrecta). En función de la opción enviada, mostrar el volumen de la figura seleccionada

// Prisma: Volumen = A * h
// Cilindro: Volumen = A * r * r * h
// Cono: Volumen = A * r * r * h / 3
// Esfera: Volumen = 4 * A * r * r * r / 3

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

            if (isset($_REQUEST["enviar"])) {

                $areaBase = intval($_REQUEST["areaBase"]);
                $altura = intval($_REQUEST["altura"]);
                $radio = intval($_REQUEST["radio"]);
                $opcion = intval($_REQUEST["opcion"]);

                switch ($opcion) {
                    case 1:
                        echo "Prisma: Volumen = $areaBase * $altura <br>";
                        echo "El resultado es = ";
                        $resultado = $areaBase * $altura;
                        echo $resultado;

                        if (empty($radio)) {
                            echo "";
                        } else {
                            echo "<br>Error esta formula no necesita Radio";
                        }

                        break;
                    case 2:
                        echo "Cilindro: Volumen = $areaBase * $radio * $radio * $altura <br>";
                        echo "El resultado es = ";
                        $resultado = $areaBase * $radio * $radio * $altura;
                        echo $resultado;

                        break;
                    case 3:
                        echo "Cono: Volumen = $areaBase * $radio * $radio * $altura / 3 <br>";

                        echo "El resultado es = ";
                        $resultado = $areaBase * $radio * $radio * $altura / 3;
                        echo $resultado;

                        break;
                    case 4:
                        echo "Esfera: Volumen = 4 * $areaBase * $radio * $radio * $radio / 3 <br>";

                        echo "El resultado es = ";
                        $resultado = 4 * $areaBase * $radio * $radio * $radio / 3;
                        echo $resultado;

                        if (empty($altura)) {
                            echo "";
                        } else {
                            echo "<br>Error esta formula no necesita Altura";
                        }

                        break;
                }
            }

            ?>
        </p>
    </section>
    <form action="#" method="post" class="form">
        <fieldset class="w-50">
            <label for="areaBase" class="form-label">Área base</label>
            <input type="text" name="areaBase" id="areaBase" class="form-control"><br>
            <label for="altura" class="form-label">Altura</label>
            <input type="text" name="altura" id="altura" class="form-control"><br>
            <label for="radio" class="form-label">Radio</label>
            <input type="text" name="radio" id="radio" class="form-control"><br>
            <select name="opcion" class="form-control">
                <option value="1" selected>1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
            <br>
            <input type="submit" value="Enviar" class="form-control" name="enviar">
        </fieldset>
    </form>



</body>

</html>