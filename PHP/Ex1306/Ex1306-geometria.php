<?php

declare(strict_types=1);
require '../../vendor/autoload.php';

$whoops = new Whoops\Run();
$whoops->pushHandler(new Whoops\Handler\PrettyPageHandler());
$whoops->register();

//  Crear una clase llamada Geometria con los siguientes atributos: b (base) y a (altura). 
//  Añadir un constructor con ambos atributos como parámetros.
//  Definir el método toString que devolverá los valores de Base y Altura.
//  Heredar de Geometría dos clases: Triangulo y Rectángulo.
//  La clase Triangulo tiene un constructor heredado de la superclase.
//  La clase Triangulo tiene un método toString heredado de la Superclase. Escribe el rótulo Triangulo y pone los datos heredados de la Superclase.
//  La clase Triangulo tiene el método area. Devuelve el área en un mensaje.
//  La clase Rectangulo tiene un constructor heredado de la superclase.
//  La clase Rectangulo tiene un método toString heredado de la Superclase. Escribe el rótulo Rectángulo y pone los datos heredados de la Superclase.
//  La clase Rectangulo tiene el método area. Devuelve el área en un mensaje. 
//  Crear sendas instancias de ambas subclases con los valores de entrada Base=10 y Altura=5, escribir ambos objetos, 
//  llamar en ambos casos al método area y volver a escribir ambos objetos de nuevo.

// La fórmula triangulo es Área = base x altura / 2 
// La formula rectangulo es Área = base x altura. 

class Geometria
{

    public int $b;
    public int $a;

    public function __construct($b, $a)
    {

        $this->b = $b;
        $this->a = $a;

    }

    public function __toString(): string
    {
        $mensaje = "La base es: $this->b <br>
        La altura es: $this->a <br>";

        return $mensaje;
    }

}

class Triangulo extends Geometria
{
    //Como es una clase hererada no necesitamos el contructor ni el tostring por que la tenemos de la clase padre
    //pero en esta nos interesa por que hay que añadir en mi caso Triagulo si no no hace falta por el tostring

    public function __toString(): string
    {

        $mensaje = "Triangulo <br>" . parent::__toString();

        return $mensaje;
    }

    function area(int $b, int $a)
    {

        $calculo = $b * $a / 2;

        $mensaje = "El area del triangulo es $calculo";

        return $mensaje;
    }


}

class Rectángulo extends Geometria
{

    public function __toString(): string
    {

        $mensaje = "<br>Rectangulo <br>" . parent::__toString();

        return $mensaje;
    }

    function area()
    {

        $calculo = $this->b * $this->a;

        $mensaje = "El area del Rectangulo es $calculo";

        return $mensaje;
    }
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

            $triangulo = new Triangulo(10, 5);
            $rectangulo = new Rectángulo(10, 5);
            echo $triangulo;
            echo $triangulo->area(10, 5);
            echo $rectangulo;
            echo $rectangulo->area();

            ?>
        </p>
    </section>

    <?php
    ?>
</body>

</html>