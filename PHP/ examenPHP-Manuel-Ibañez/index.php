<?php

declare(strict_types=1);

require("PHP/funciones.php");
ErroresVendor();
session_start();


if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="CSS/estilosNavbar.css" rel="stylesheet" />
    <title>Menu Examen Crud</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <header>
        <nav class="navbar navbar-dark navbar-expand navbar-custom">
            <div class="container-fluid">
                <a class="navbar-brand">Home</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link active navbar-letra" aria-current="page"
                                href="PHP/crudCliente/listarCliente.php"> <span class="navbar-color">#</span>Acciones
                                Cliente</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active navbar-letra" aria-current="page"
                                href="PHP/crudEmpleado/listarEmpleado.php"><span class="navbar-color">#</span>Acciones
                                Empleado</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active navbar-letra" aria-current="page"
                                href="PHP/crudFacturas/listarFactura.php"><span class="navbar-color">#</span>Acciones
                                Facturas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active navbar-letra" aria-current="page"
                                href="PHP/crudCoche/listarCoche.php"><span class="navbar-color">#</span>Acciones de
                                Coches</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <section aria-label="info" class="p-3 m-2 border-0 bd-example mx-auto">
        <h1 class="text-center mb-4">Conectar BBDD</h1>
        <p class="alert alert-info w-50 mx-auto">
            <?php

            if (isset($_REQUEST["cargarBBDD"])) {

                $conexion = mysqli_connect('localhost', 'root', 'root');

                if ($conexion->connect_errno) {
                    echo "Fallo al conectar a MySQL: (" . $conexion->connect_errno . ") " . $conexion->connect_error;
                } else {
                    echo "Base de datos creada correctamente";

                    $ContenidoSql = file_get_contents("Hyundai.sql");
                    $cargar = $conexion->multi_query($ContenidoSql);


                }


            }
            echo "Estas conectado a la base de datos";

            ?>
        </p>
    </section>
    <form action="PHP/crudCliente/listarCliente.php" method="post" class="form d-flex justify-content-center mb-4">
        <fieldset class="w-50 mx-auto">
            <input type="submit" value="Carga la BBDD" class="form-control" name="cargarBBDD">
        </fieldset>
    </form>

    <div class="container d-flex justify-content-center pb-4">
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

                                    $conexionConsulta = conectarBBDD("localhost", "root", "root", "Hyundai");

                                    $sql = "SELECT nif,nombre FROM Cliente WHERE Activo = 0";
                                    $personasInactivas = $conexionConsulta->query($sql);
                                    $personasInactivasLista = $personasInactivas->fetch_all(MYSQLI_ASSOC);

                                    $sql2 = "SELECT nif,nombre FROM Empleado WHERE Activo = 0";
                                    $personasInactivasEmpleados = $conexionConsulta->query($sql2);
                                    $personasInactivasEmpleadosLista = $personasInactivasEmpleados->fetch_all(MYSQLI_ASSOC);

                                    $sql3 = "SELECT * FROM Cliente";
                                    $personasClientes = $conexionConsulta->query($sql3);
                                    $personasClientesLista = $personasClientes->fetch_all(MYSQLI_ASSOC);

                                    foreach ($personasInactivasLista as $persona) {
                                        echo "<option value='" . $persona['nif'] . "'> DNI: " . $persona['nif'] . ", nombre: " . $persona['nombre'] . "</option>";
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
        <div class="container justify-content-center">
            <div class="row-12">

                <?php
                if (isset($_REQUEST['inactivos']) && isset($_REQUEST['nif'])) {
                    $nif = $_REQUEST['nif'];
                    $Clientes = $conexion->query("SELECT * FROM Cliente WHERE nif = '$nif'");
                    $conexion->query($sql);

                    foreach ($Clientes as $Cliente) {
                        echo '  <div class="col-12 mb-3 mt-4">
                            <h2 class="text-center">Alta de Clientes</h2>
                        </div>
                        <div class="col-8 mx-auto">';
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
                        echo "</form>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                }
                ?>
            </div>
        </div>
    </div>


    <div class="container d-flex justify-content-center pb-4">
        <div class="row">
            <div class="col-12 mb-3 mt-4">
                <h2 class="text-start">Buscar Empleado Parado</h2>
            </div>
            <div class="col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <form action="#" method="POST">
                            <div class="form-group pb-2">
                                <select class="form-select" aria-label="Default select example" name="nif">
                                    <?php
                                    foreach ($personasInactivasEmpleadosLista as $personaEmpleados) {
                                        echo "<option value='" . $personaEmpleados['nif'] . "'>DNI: " . $personaEmpleados['nif'] . ", nombre: " . $personaEmpleados['nombre'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block text-white "
                                    name="inactivosEmpleados">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="container justify-content-center">
            <div class="row-12">
                <?php
                if (isset($_REQUEST['inactivosEmpleados']) && isset($_REQUEST['nif'])) {
                    $nifEmpledo = $_REQUEST['nif'];
                    $ClientesEmpleados = $conexion->query("SELECT * FROM Empleado WHERE nif = '$nifEmpledo'");
                    $conexion->query($sql);

                    echo '<div class="col-12 mb-3 mt-4">
                        <h2 class="text-center">Alta de Empleados</h2>
                    </div>
                    <div class="col-8 mx-auto">';

                    foreach ($ClientesEmpleados as $empleados) {
                        echo '<div class="card h-100">';
                        echo '<div class="card-body">';
                        echo '<form action="PHP/crudCliente/recuperarClientes.php" method="POST">';
                        echo "<input type='hidden' id='nif' name='nif' value='" . $empleados['nif'] . "'>";
                        echo "<div class='form-group pb-2'>";
                        echo "<input type='text' id='nif' name='nif' class='form-control' placeholder='NIF' minlength='9' maxlength='9' required value='" . $empleados['nif'] . "' disabled='disabled'>";
                        echo "</div>";
                        echo "<div class='form-group pb-2'>";
                        echo "<input type='text' id='nombre' name='nombre' class='form-control' placeholder='Nombre' maxlength='50' required value='" . $empleados['nombre'] . "' disabled='disabled'>";
                        echo "</div>";
                        echo "<div class='form-group pb-2'>";
                        echo "<input type='date' id='fecha_contratacion' name='fecha_contratacion' class='form-control' maxlength='50' placeholder='Direccion' required value='" . $empleados['fecha_contratacion'] . "' disabled='disabled'>";
                        echo "</div>";
                        echo "<div class='form-group pb-2'>";
                        echo "<input type='text' id='salario' name='salario' class='form-control' min='1' max='100' placeholder='Telefono' required value='" . $empleados['salario'] . "' disabled='disabled'>";
                        echo "</div>";
                        echo "<div class='form-group pb-4'>";
                        echo "<input type='text' id='telefono' name='telefono' class='form-control' maxlength='50' placeholder='Fecha de alta' required value='" . $empleados['telefono'] . "' disabled='disabled'>";
                        echo "</div>";
                        echo "<div class='form-group'>";
                        echo "<button type='submit' class='btn btn-success btn-block text-white '>Activar</button>";
                        echo "</div>";
                        echo "</form>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                }
                ?>
            </div>
        </div>
    </div>


    <div class="container d-flex justify-content-center pb-4">
        <div class="row">
            <div class="col-12 mb-3 mt-4">
                <h2 class="text-start">Coches Comprados Cliente</h2>
            </div>
            <div class="col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <form action="PHP/listadoCochesEmpleados.php" method="POST">
                            <div class="form-group pb-2">
                                <select class="form-select" aria-label="Default select example" name="nif">
                                    <?php
                                    foreach ($personasClientesLista as $personaCliente) {
                                        echo "<option value='" . $personaCliente['nif'] . "'>DNI: " . $personaCliente['nif'] . ", nombre:" . $personaCliente['nombre'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block text-white "
                                    name="empleadosParaListaCoche">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="container justify-content-center">
            <div class="row-12">
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