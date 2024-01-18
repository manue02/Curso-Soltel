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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="#" rel="stylesheet" />
    <title>Listar Cliente</title>
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

    <section aria-label="info" class="d-flex justify-content-center">
        <p class="alert alert-info w-50 text-center">
            <?php
            $sql = "SELECT * FROM Cliente";
            $registros = $conexion->query($sql);
            $num_registros = $registros->num_rows;
            $contadorActivos = 0;

            if ($num_registros > 0) {
                foreach ($registros as $registro) {
                    if ($registro['Activo'] == 1) {
                        $contadorActivos++;
                    }
                }

                $resultado = "Encontrados <b>$contadorActivos Registros </b> de Clientes <b>Activos</b>";

            } else {
                $resultado = "Tabla Vacia";
            }
            echo $resultado;
            ?>
        </p>
    </section>
    <section class="p-3">
        <div class="row table-responsive">
            <div class="col-12">
                <table class="table table-striped table-hover mt-3 text-center table-bordered">
                    <thead>
                        <tr>
                            <th>NIF</th>
                            <th>Nombre</th>
                            <th>Direccion</th>
                            <th>Telefono</th>
                            <th>fecha_alta</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        foreach ($registros as $registro) {
                            if ($registro['Activo'] == 1) {

                                echo "<tr>";
                                echo "<td>" . $registro['nif'] . "</td>";
                                echo "<td>" . $registro['nombre'] . "</td>";
                                echo "<td>" . $registro['direccion'] . "</td>";
                                echo "<td>" . $registro['telefono'] . "</td>";
                                echo "<td>" . $registro['fecha_alta'] . "</td>";
                                echo "<td>";
                                echo "<div class='row'>";
                                echo "<div class='col'><a href='CrearClienteFormulario.php'><ion-icon name='add-outline' class='fs-2'></ion-icon></a></div>";
                                echo "<div class='col'><a href='editarClienteFormulario.php?nif=" . $registro['nif'] . "'><ion-icon name='create-outline' class='fs-2'></ion-icon></a></div>";
                                echo "<div class='col'><a href='eliminarCliente.php?nif=" . $registro['nif'] . "''><ion-icon name='trash-outline' class='fs-2'></ion-icon></a></div>";
                                // echo "<div class='col'><a href='recuperarCliente.php?nif=" . $registro['nif'] . "''><ion-icon name='refresh-outline' class='fs-2'></ion-icon></a></div>";
                                echo "</div>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

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