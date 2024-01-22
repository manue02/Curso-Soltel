<?php
declare(strict_types=1);

require("../funciones.php");
ErroresVendor();
$conexion = conectarBBDD("localhost", "root", "root", "Hyundai");

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$sqlCliente = "SELECT nif as nif_cliente, nombre as nombre_cliente FROM Cliente where activo = 1";
$sqlEmpleado = "SELECT nif as nif_empleado, nombre as nombre_empleado FROM Empleado where activo = 1";
$sqlCoche = "SELECT matricula as matricula_coche, modelo as modelo_coche FROM Coche";

$resultadoEmpleado = mysqli_query($conexion, $sqlEmpleado);
$resultadoCliente = mysqli_query($conexion, $sqlCliente);
$resultadoCoche = mysqli_query($conexion, $sqlCoche);


?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de Facturas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="../../CSS/estilosNavbar.css" rel="stylesheet" />

</head>

<body>

    <header>
        <nav class="navbar navbar-dark navbar-expand navbar-custom">
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
                            <a class="nav-link active navbar-letra" aria-current="page" href="listarFactura.php"><span
                                    class="navbar-color">#</span>Acciones
                                Facturas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active navbar-letra" aria-current="page"
                                href="../crudCoche/listarCoche.php"><span class="navbar-color">#</span>Acciones de
                                Coches</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="container d-flex justify-content-center">
        <div class="row">
            <div class="col-12 mb-3 mt-4">
                <h1 class="text-center">Añadir una Factura</h1>
            </div>
            <div class="col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <form action="crearFactura.php" method="POST">
                            <div class="form-group pb-2">
                                <select class="form-select" aria-label="Default select example" name="nif_empleado">
                                    <?php
                                    echo "<option selected>Selecciona un Empleado</option>";
                                    foreach ($resultadoEmpleado as $filaEmpleado) {
                                        echo "<option value='" . $filaEmpleado['nif_empleado'] . "'>" . "NIF Empleado: " . $filaEmpleado['nif_empleado'] . ", Nombre: " . $filaEmpleado['nombre_empleado'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group pb-2">
                                <input type="date" id="fecha_factura" name="fecha_factura" class="form-control"
                                    maxlength="50" placeholder="Fecha de Contratacion" required>
                            </div>
                            <div class="form-group pb-2">
                                <select class="form-select" aria-label="Default select example" name="nif_cliente">
                                    <?php
                                    echo "<option selected>Selecciona un Cliente</option>";
                                    foreach ($resultadoCliente as $filaCliente) {

                                        echo "<option value='" . $filaCliente['nif_cliente'] . "'>" . "NIF Cliente: " . $filaCliente['nif_cliente'] . ", Nombre: " . $filaCliente['nombre_cliente'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group pb-2">
                                <select class="form-select" aria-label="Default select example" name="matricula">
                                    <?php
                                    echo "<option selected>Selecciona un Coche</option>";
                                    foreach ($resultadoCoche as $filaCoche) {
                                        echo "<option value='" . $filaCoche['matricula_coche'] . "'>" . "Matricula: " . $filaCoche['matricula_coche'] . ", Modelo: " . $filaCoche['modelo_coche'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group pb-4">
                                <input type="text" id="total" name="total" class="form-control"
                                    placeholder="Total Factura" maxlength="50" required>
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