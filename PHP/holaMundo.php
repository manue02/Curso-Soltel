<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operadores PHP</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/docs.css">
    <script src="bootstrap/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style></style>
</head>

<body>
    <?php
    $numPrimero = "1";  // String
    $numSegundo = 1;    // int
    
    if ($numPrimero == $numSegundo) {
        echo "Son iguales de contenido! <br>";
    }
    if ($numPrimero === $numSegundo) {
        echo "Son iguales de contenido + Tipo! <br>";
    }

    // Al usar el PostIncremento, hace una conversión implícita
    $numPrimero++;      // = $numPrimero = $numPrimero + 1
    echo $numPrimero . "<br>";

    $numPrimero--;      // = $numPrimero = $numPrimero - 1
    echo $numPrimero . "<br>";


    //definidas 3 varibles dime cual es el mayor, el mediano y el menor
    $num1 = 10;
    $num2 = 20;
    $num3 = 30;

    if ($num1 < $num2 && $num1 < $num3 && $num2 < $num3) {
        echo "El mayor es: $num3  <br>";
    } elseif ($num2 > $num1 && $num2 > $num3 && $num1 > $num3) {
        echo "El mayor es: $num2  <br>";
    } else {
        echo "El mayor es: $num1  <br>";
    }

    if ($num2 > $num1 && $num2 < $num3 && $num1 < $num3) {
        echo "El mediano es: $num2  <br>";
    } elseif ($num1 < $num2 && $num1 > $num3 && $num2 > $num3) {
        echo "El mediano es: $num1  <br>";
    } else {
        echo "El mediano es: $num3  <br>";
    }

    if ($num1 < $num2 && $num1 < $num3 && $num2 < $num3) {
        echo "El menor es: $num1  <br>";
    } elseif ($num2 > $num1 && $num2 > $num3 && $num1 > $num3) {
        echo "El menor es: $num3  <br>";
    } else {
        echo "El menor es: $num2  <br>";
    }


    ?>
</body>

</html>