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
    <title>Listar Facturas</title>
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

    <section aria-label="info" class="d-flex justify-content-center">
        <p class="alert alert-info w-50 text-center">
            <?php
            $sql = " SELECT DISTINCT Factura.numero_factura as 'numero_factura', 
            Factura.nif_vendedor as 'nif_vendedor', 
            Empleado.nombre as 'nombre_vendedor', 
            Factura.fecha as 'fecha', 
            Cliente.nif as 'nif_cliente', 
            Cliente.nombre as 'nombre_cliente', 
            Cliente.telefono as 'telefono', 
            Coche.matricula as matricula_coche_comprado, 
            Coche.modelo as modelo_coche_comprado, 
            Factura.total as 'total',
            Factura.Activo as 'Activo'
        FROM 
            Factura
        INNER JOIN 
            Empleado ON Factura.nif_vendedor = Empleado.nif
        INNER JOIN 
            Cliente ON Factura.nif_cliente = Cliente.nif
        INNER JOIN 
            Coche ON Factura.matricula_coche_comprado = Coche.matricula";
            $registros = $conexion->query($sql);
            $num_registros = $registros->num_rows;
            $contadorActivos = 0;

            if ($num_registros > 0) {
                foreach ($registros as $registro) {
                    if ($registro['Activo'] == 1) {
                        $contadorActivos++;
                    }
                }

                $resultado = "Encontrados <b>$contadorActivos Registros </b> de las Facturas <b>Activos</b>";

            } else {
                $resultado = "Tabla Vacia";
            }
            echo $resultado;
            ?>
        </p>
    </section>
    <section class="p-3">
        <div class="row table-responsive">
            <div class="col-12 mb-3 mt-4">
                <h2 class="text-center">Lista de Facturas</h2>
            </div>
            <div class="col-12 d-flex justify-content-end ">
                <a href='crearFacturaFormulario.php' class='btn btn-outline-primary btn-lg'>
                    Añadir Factura
                </a>
            </div>
            <div class="col-12">
                <table class="table table-striped table-hover mt-3 text-center table-bordered">
                    <thead>
                        <tr>
                            <th>NIF Vendedor</th>
                            <th>Nombre Vendedor</th>
                            <th>Fecha Compra</th>
                            <th>NIF Cliente</th>
                            <th>Nombre Cliente</th>
                            <th>Telefono Cliente</th>
                            <th>Matricula Coche comprado</th>
                            <th>Modelo Coche comprado</th>
                            <th>Total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        foreach ($registros as $registro) {
                            if ($registro['Activo'] == 1) {

                                echo "<tr>";
                                echo "<td>" . $registro['nif_vendedor'] . "</td>";
                                echo "<td>" . $registro['nombre_vendedor'] . "</td>";
                                echo "<td>" . $registro['fecha'] . "</td>";
                                echo "<td>" . $registro['nif_cliente'] . "</td>";
                                echo "<td>" . $registro['nombre_cliente'] . "</td>";
                                echo "<td>" . $registro['telefono'] . "</td>";
                                echo "<td>" . $registro['matricula_coche_comprado'] . "</td>";
                                echo "<td>" . $registro['modelo_coche_comprado'] . "</td>";
                                echo "<td>" . $registro['total'] . "€</td>";
                                echo "<td>";
                                echo "<div class='row'>";
                                echo "<div class='col'><a href='eliminarFactura.php?numero_factura=" . $registro['numero_factura'] . "''><ion-icon name='trash-outline' class='fs-2'></ion-icon></a></div>";
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