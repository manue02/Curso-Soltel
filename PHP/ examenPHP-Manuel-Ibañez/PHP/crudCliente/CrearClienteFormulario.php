<?php
declare(strict_types=1);

require("../funciones.php");
ErroresVendor();
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de Clientes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
            <a class="navbar-brand" href="../../index.php">Home</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link " href="listarCliente.php">Acciones Cliente</a>
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
                <h1 class="text-center">Alta de Clientes</h1>
            </div>
            <div class="col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <form action="CrearCliente.php" method="POST">
                            <div class="form-group pb-2">
                                <input type="text" id="nif" name="nif" class="form-control" placeholder="NIF"
                                    minlength="9" maxlength="9" required>
                            </div>
                            <div class="form-group pb-2">
                                <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre"
                                    maxlength="50" required>
                            </div>
                            <div class="form-group pb-2">
                                <input type="text" id="direccion" name="direccion" class="form-control" maxlength="50"
                                    placeholder="Direccion" required>
                            </div>
                            <div class="form-group pb-2">
                                <input type="text" id="telefono" name="telefono" class="form-control" min="1" max="100"
                                    placeholder="Telefono" required>
                            </div>
                            <div class="form-group pb-4">
                                <input type="date" id="fecha_alta" name="fecha_alta" class="form-control" maxlength="50"
                                    placeholder="Fecha de alta" required>
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