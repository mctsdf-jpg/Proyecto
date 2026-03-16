<?php
session_start();
require "conexion.php";

$error = ""; // Variable para mostrar errores

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $correo = $_POST["correo"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM usuarios WHERE correo = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();

        if (password_verify($password, $usuario["password"])) {

            $_SESSION["id"] = $usuario["id"];
            $_SESSION["nombre"] = $usuario["nombre"];

            header("Location: productos.php");
            exit();

        } else {
            $error = "Contraseña incorrecta";
        }

    } else {
        $error = "Correo no registrado";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="MercaSuper">
    <meta name="author" content="Juan Ojeda">
    <title>Inicio de sesión</title>
    <link rel="icon" href="imagenes/logo.png">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">
        <!-- Columna de información -->
        <div class="info">
            <p class="txt-1">Gracias por visitarnos</p>
            <h2>Bienvenidos a MercaSuper</h2>
        </div>

        <!-- Formulario de login -->
        <form class="form" method="POST">
            <h2>Inicio de sesión</h2>
            <img src="imagenes/logo.png" alt="Logo" height="80">
            <p>Entra y disfruta de nuestra gran variedad de productos</p>

            <input id="correo" type="email" name="correo" placeholder="Correo" required>
            <input id="password" type="password" name="password" placeholder="Contraseña" required>
            <input type="submit" value="Login">

            <p><a href="registro.php">Crear cuenta</a></p>

            <?php
            if (!empty($error)) {
                echo "<p style='color:red; margin-top:10px;'>$error</p>";
            }
            ?>
        </form>
    </div>

</body>
</html>