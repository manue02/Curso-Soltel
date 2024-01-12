<?php

declare(strict_types=1);
require '../../vendor/autoload.php';

$whoops = new Whoops\Run();
$whoops->pushHandler(new Whoops\Handler\PrettyPageHandler());
$whoops->register();

//  Definir una clase ABSTRACTA Deportista, con los atributos identidad (String), edad (int) y sexo (booleano). 
//     Incluir su constructor COMPLETO (con todos los atributos de parámetros).
//         Añadir el toString y el método abstracto federarse que tendrá que implementarse en las subclases con el mensaje “Estoy Federado”.
//  Definir una INTERFAZ Eventos: métodos concentrarse (“Concentrado!) y viajar (“Viajo!”).
//  Definir TRAIT Partido: métodos jugarPartido (“Voy a jugar”) y dirigirPartido (“Soy el Mister”)
//  Definir la CLASE para COMPOSICIÓN Club con los atributos denominacion (String) y fundacion (int). Incluir su constructor COMPLETO (con todos los atributos de parámetros).
//        Esta clase se incluirá en los constructores de Futbolista y Entrenador. Ejemplos:
//  RealBetis → “Real Betis Balompie”, 1907
//  SevillaFC → “Sevilla Fútbol Club, 1890
//  RealMadrid → “Real Madrid CF”, 1902
//  Definir la SUBCLASE Futbolista con el atributo dorsal (int). Incluir el constructor COMPLETO (OJO!, identidad, edad, sexo y dorsal). Incluir el toString con todos los atributos.
//  Definir la SUBCLASE Entrenador con el atributo inicioEntrenador (int). Constructor y toString.


abstract class Deportista
{

    public string $identidad;
    public int $edad;
    public bool $sexo;

    public function __construct($identidad, $edad, $sexo)
    {

        $this->identidad = $identidad;
        $this->edad = $edad;
        $this->sexo = $sexo;

    }

    public function __toString(): string
    {

        if ($this->sexo) {
            $persona = "Hombre <br>";
        } else {
            $persona = "Mujer <br>";
        }

        $mensaje = "La identidad es: $this->identidad <br> La edad es: $this->edad <br> El sexo es: $persona";

        return $mensaje;

    }

    abstract public function federarse();
}

interface Eventos
{

    public function concentrarse();

    public function viajar();

}

trait Partido
{

    public function jugarPartido()
    {
        echo "¡Voy a jugar!";
    }

    public function dirigirPartido()
    {
        echo "¡Soy el Mister!";
    }

}

class Club
{

    public string $denominacion;

    public int $fundacion;


    public function __construct($denominacion, $fundacion)
    {

        $this->denominacion = $denominacion;
        $this->fundacion = $fundacion;

    }

    public function __toString(): string
    {

        $mensaje = "La denominacion es: $this->denominacion <br> La fundacion es: $this->fundacion";

        return $mensaje;

    }

}

class Futbolista extends Deportista implements Eventos
{
    public int $dorsal;
    public Club $betis;

    public function __construct($identidad, $edad, $sexo, $dorsal)
    {

        parent::__construct($identidad, $edad, $sexo);

        $this->dorsal = $dorsal;

        $this->betis = new Club("Real Betis", 1999);

    }

    public function __toString(): string
    {

        $mensaje = parent::__toString() .
            "Dorsal: $this->dorsal <br>
        $this->betis <br>";
        return $mensaje;
    }

    public function federarse()
    {
        return "Estoy Federado - ";

    }

    public function concentrarse()
    {
        return "Concentrado! - ";
    }

    public function viajar()
    {
        return "Viajo! <br>";
    }


}



class Entrenador extends Deportista
{
    public int $inicioEntrenador;
    public Club $betis;

    public function __construct($identidad, $edad, $sexo, $inicioEntrenador)
    {

        parent::__construct($identidad, $edad, $sexo);

        $this->inicioEntrenador = $inicioEntrenador;

        $this->betis = new Club("Real Betis", 1999);


    }

    public function __toString(): string
    {

        $mensaje = parent::__toString() .
            "Inicio del entrenador: $this->inicioEntrenador <br>
        $this->betis <br>";
        return $mensaje;
    }

    public function federarse()
    {
        return "Estoy Federado - ";
    }

    use Partido;

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

            $jugador = new Futbolista("Jose Manuel", 30, true, 4);
            $entrenador = new Entrenador("Manuel Yuyi", 20, false, 2020);


            echo $jugador;
            echo $jugador->federarse();
            echo $jugador->concentrarse();
            echo $jugador->viajar();
            echo "<br>" . $entrenador;
            echo $entrenador->dirigirPartido() . " - ";
            echo $entrenador->jugarPartido();


            ?>
        </p>
    </section>

    <?php
    ?>
</body>

</html>