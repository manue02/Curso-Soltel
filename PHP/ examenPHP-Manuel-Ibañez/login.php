<?php
declare(strict_types=1);

session_start();


// Tratar formulario
if (isset($_REQUEST['enviar'])) {
    $usuario = $_REQUEST['usuario'];
    $clave = $_REQUEST['clave'];

    if ($usuario == "admin" && $clave == "admin" || $usuario == "soltel" && $clave == "soltel") {
        $_SESSION['usuario'] = $usuario;
        header("Location: index.php");
        exit();
    } else {
        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="CSS/estilosLogin.css" rel="stylesheet" />
    <title>Iniciar Sesion</title>
</head>

<body>
    <section>
        <article>
            <header class="form-value">
                <form id="#" method="post">
                    <h2>Inicio de Sesion</h2>
                    <main>
                        <section>
                            <ion-icon name="mail-outline"></ion-icon>
                            <input type="text" required name="usuario" />
                            <label for="">Usuario</label>
                        </section>
                        <section>
                            <ion-icon name="lock-closed-outline"></ion-icon>
                            <input type="password" required name="clave" />
                            <label for="">Password</label>
                        </section>
                        <input class="Custombutton mb-4 text-center" type="submit" name="enviar" value="Entrar" />
                    </main>
                    <footer class="register">
                        <p>El usuario y contraseña es soltel/soltel o admin/admin</p>
                    </footer>
                </form>
            </header>
        </article>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>