<?php

declare(strict_types=1);
require '../vendor/autoload.php';

$whoops = new Whoops\Run();
$whoops->pushHandler(new Whoops\Handler\PrettyPageHandler());
$whoops->register();

//  Pedir al usuario 2 valores enteros (num1 y num2) en el formulario.
//  Ambos números deben ser mayores que 0 y menores de 20. 
//  Num2 debe ser mayor que Num1. La distancia de ambos deberá ser como mínimo de 10.
//  Si no se cumplen TODOS los requerimientos, mostrar un mensaje “Datos incorrectos”.
//  Crear una función llamada tabMultiplicarPrimos (num1,num2) que devuelva una cadena.
//  En dicha cadena, mostrar las tablas de multiplicar (5 ELEMENTOS) de todos los valores PRIMOS entre ambos números. 
//  Usar el método esPrimo, que devolverá 1 si es PRIMO y 0 si no es primo.
//  Un ejemplo: num1 = 2 y num2 = 8 → “Datos incorrectos” num1 = 2 y num2 = 12 Se mostrarán las tablas de multiplicar: 2,3,5,7,11

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

                $numero1 = $_REQUEST["numero1"];
                $numero2 = $_REQUEST["numero2"];

                function esPrimo($ComprobarPrimo)
                {
                    $contador = 0;
                    // repetimos el bucle tantas veces como el número que queremos comprobar (desde el 1 hasta $ComprobarPrimo) 
                    // y comprobamos si el resto de la división es 0 hasta encontrar 2 divisores (el 1 y él mismo)
                    for ($i = 1; $i <= $ComprobarPrimo; $i++) {
                        if ($ComprobarPrimo % $i == 0) {
                            $contador++;
                        }
                    }
                    // si el contador es igual a 2, significa que el número es primo ya que tiene solamente 2 divisores: el 1 y él mismo
                    if ($contador == 2) {
                        return 1;
                    } else {
                        return 0;
                    }
                }

                function tabMultiplicarPrimos($numero1, $numero2)
                {
                    $cadena = "";
                    $contador = 0;
                    // recorremos todos los números desde el $numero1 hasta el $numero2
                    for ($i = $numero1; $i <= $numero2; $i++) {
                        // si el número es primo, mostramos la tabla de multiplicar
                        if (esPrimo($i) == 1) {
                            $cadena = $cadena . "Tabla de multiplicar del " . $i . "<br>";
                            for ($j = 1; $j <= 10; $j++) {
                                $cadena = $cadena . $i . " x " . $j . " = " . $i * $j . "<br>";
                            }
                            $contador++;
                        }
                    }
                    // si no hay números primos, mostramos un mensaje
                    if ($contador == 0) {
                        $cadena = "No hay números primos entre " . $numero1 . " y " . $numero2;
                    }
                    // devolvemos la cadena
                    return $cadena;

                }

                // comprobamos que los números sean correctos
                if ($numero1 > 0 && $numero1 < 20 && $numero2 > 0 && $numero2 < 20) {
                    if ($numero2 > $numero1) {
                        if ($numero2 - $numero1 >= 10) {
                            echo "Datos correctos";
                            echo "<br>";
                            echo tabMultiplicarPrimos($numero1, $numero2);
                        } else {
                            echo "Datos incorrectos";
                        }
                    } else {
                        echo "Datos incorrectos";
                    }
                } else {
                    echo "Datos incorrectos";

                }
            }

            ?>
        </p>
    </section>
    <form action="#" method="post" class="form">
        <fieldset class="w-50">
            <label for="numero1" class="form-label">Numero 1</label>
            <input type="text" name="numero1" id="numero1" class="form-control"><br>
            <label for="numero2" class="form-label">Numero 2</label>
            <input type="text" name="numero2" id="numero2" class="form-control"><br>
            <br>
            <input type="submit" value="Enviar" class="form-control" name="enviar">
        </fieldset>
    </form>
</body>

</html>