<?php
declare(strict_types=1);

require("../funciones.php");
ErroresVendor();
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../../login.php");
    exit();
}


$matricula = $_REQUEST['matricula'];

$conexion = new mysqli("localhost", "root", "root", "Hyundai");

$sql = "SELECT * FROM Coche WHERE matricula = '$matricula'";

foreach ($conexion->query($sql) as $fila) {
    $matricula = $fila['matricula'];
    $modelo = $fila['modelo'];
    $ano_fabricacion = $fila['ano_fabricacion'];
    $tipo_combustible = $fila['tipo_combustible'];
    $precio = $fila['precio'];
    $color = $fila['color'];
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Coches</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="../../CSS/estilosNavbar.css" rel="stylesheet" />

</head>

<body>
<header>
        <nav class="navbar navbar-dark navbar-expand navbar-custom mb-4">
            <div class="container-fluid">
                <a class="navbar-brand" href="../../index.php">Home</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link active navbar-letra" aria-current="page"
                                href="../crudCliente/listarCliente.php"> <span class="navbar-color">#</span>Acciones
                                Cliente</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active navbar-letra" aria-current="page"
                                href="../crudEmpleado/listarEmpleado.php"><span class="navbar-color">#</span>Acciones
                                Empleado</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active navbar-letra" aria-current="page"
                                href="../crudFacturas/listarFactura.php"><span class="navbar-color">#</span>Acciones
                                Facturas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active navbar-letra" aria-current="page" href="listarCoche.php"><span
                                    class="navbar-color">#</span>Acciones de Coches</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="container d-flex justify-content-center">
        <div class="row">
            <div class="col-12 mb-3 mt-4">
                <h1 class="text-center">Editar Coche</h1>
            </div>
            <div class="col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <form action="editarCoche.php?matricula=<?php echo $matricula ?>" method="POST"
                            class="form-group pb-2">
                            <div class="form-group pb-2">
                                <input type="text" id="matricula" name="matricula" class="form-control" placeholder="matricula"
                                    minlength="9" maxlength="9" required value="<?php echo $matricula ?>"
                                    disabled="disabled">
                            </div>
                            <div class="form-group pb-2">
                                <input type="text" id="modelo" name="modelo" class="form-control" placeholder="Modelo"
                                    maxlength="50" value="<?php echo $modelo ?>" required>
                            </div>
                            <div class="form-group pb-2">
                                <input type="number" id="ano_fabricacion" name="ano_fabricacion" class="form-control"
                                    maxlength="50" placeholder="Año de fabricacion"
                                    value="<?php echo $ano_fabricacion ?>" required>
                            </div>
                            <div class="form-group pb-2">
                                <select class="form-select" aria-label="Default select example" name="tipo_combustible">
                                    <option selected>Tipo de combustible</option>
                                    <option value="diesel">Diesel</option>
                                    <option value="gasolina">Gasolina</option>
                                    <option value="electrico">Electrico</option>
                                    <option value="hibrido">Hibrido</option>
                                </select>
                            </div>
                            <div class="form-group pb-2">
                                <input type="text" id="precio" name="precio" class="form-control" min="1" max="100"
                                    placeholder="Precio" value="<?php echo $precio ?>" required>
                            </div>
                            <div class="form-group pb-4">
                                <input type="text" id="color" name="color" class="form-control" min="1" max="100"
                                    placeholder="Color" value="<?php echo $color ?>" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block text-white ">Guardar</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
</body>

</html>