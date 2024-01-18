<?php

declare(strict_types=1);

require("PHP/funciones.php");
ErroresVendor();
session_start();
$conexion = conectarBBDD("localhost", "root", "root", "Hyundai");


if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT nif FROM Cliente WHERE Activo = 0";
$personasInactivas = $conexion->query($sql);
$personasInactivasLista = $personasInactivas->fetch_all(MYSQLI_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="#" rel="stylesheet" />
    <title>Menu Examen Crud</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand">Home</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link " href="PHP/crudCliente/listarCliente.php">Acciones Cliente</a>
                    <a class="nav-item nav-link " href="#">Acciones Empleado</a>
                    <a class="nav-item nav-link " href="#">Prueba</a>
                    <a class="nav-item nav-link " href="#">Prueba</a>
                </div>
            </div>
        </nav>
    </header>


    <div class="container d-flex justify-content-center">
        <div class="row">
            <div class="col-12 mb-3 mt-4">
                <h2 class="text-start">Buscar Clientes Inactivos</h2>
            </div>
            <div class="col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <form action="#" method="POST">
                            <div class="form-group pb-2">
                                <select class="form-select" aria-label="Default select example" name="nif">
                                    <?php
                                    foreach ($personasInactivasLista as $persona) {
                                        echo "<option value='" . $persona['nif'] . "'>" . $persona['nif'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block text-white "
                                    name="inactivos">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="container d-flex justify-content-center">
            <div class="row">
                <div class="col-12 mb-3 mt-4">
                    <h2 class="text-center">Alta de Clientes</h2>
                </div>
                <div class="col-12">
                    <?php
                    if (isset($_REQUEST['inactivos']) && isset($_REQUEST['nif'])) {
                        $nif = $_REQUEST['nif'];
                        $Clientes = $conexion->query("SELECT * FROM Cliente WHERE nif = '$nif'");
                        $conexion->query($sql);

                        foreach ($Clientes as $Cliente) {
                            echo '<div class="card h-100">';
                            echo '<div class="card-body">';
                            echo '<form action="PHP/crudCliente/recuperarClientes.php" method="POST">';
                            echo "<input type='hidden' id='nif' name='nif' value='" . $Cliente['nif'] . "'>";
                            echo "<div class='form-group pb-2'>";
                            echo "<input type='text' id='nif' name='nif' class='form-control' placeholder='NIF' minlength='9' maxlength='9' required value='" . $Cliente['nif'] . "' disabled='disabled'>";
                            echo "</div>";
                            echo "<div class='form-group pb-2'>";
                            echo "<input type='text' id='nombre' name='nombre' class='form-control' placeholder='Nombre' maxlength='50' required value='" . $Cliente['nombre'] . "' disabled='disabled'>";
                            echo "</div>";
                            echo "<div class='form-group pb-2'>";
                            echo "<input type='text' id='direccion' name='direccion' class='form-control' maxlength='50' placeholder='Direccion' required value='" . $Cliente['direccion'] . "' disabled='disabled'>";
                            echo "</div>";
                            echo "<div class='form-group pb-2'>";
                            echo "<input type='text' id='telefono' name='telefono' class='form-control' min='1' max='100' placeholder='Telefono' required value='" . $Cliente['telefono'] . "' disabled='disabled'>";
                            echo "</div>";
                            echo "<div class='form-group pb-4'>";
                            echo "<input type='date' id='fecha_alta' name='fecha_alta' class='form-control' maxlength='50' placeholder='Fecha de alta' required value='" . $Cliente['fecha_alta'] . "' disabled='disabled'>";
                            echo "</div>";
                            echo "<div class='form-group'>";
                            echo "<button type='submit' class='btn btn-success btn-block text-white '>Activar</button>";
                            echo "</div>";
                        }
                    }
                    ?>
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