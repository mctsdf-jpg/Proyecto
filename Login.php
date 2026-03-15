<?php
session_start();
require "conexion.php";

$error = ""; /// CAMBIO: variable para mostrar errores en pantalla

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

            header("Location: productos.php"); /// CORRECCIÓN: mantener solo productos.php
            exit();

        } else {
            $error = "Contraseña incorrecta"; /// CAMBIO: en lugar de alert
        }

    } else {
        $error = "Correo no registrado"; /// CAMBIO: en lugar de alert
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
</head>
<body>

<h2>Login</h2>

<p style="color:red;">
<?php echo $error; ?> 
</p> 
<!-- /// CAMBIO: mostrar mensaje de error en la página -->

<form method="POST">

    <input id="correo" type="email" name="correo" placeholder="Correo" required> 
    <!-- /// CAMBIO: agregué required -->

    <br><br>

    <input id="password" type="password" name="password" placeholder="Contraseña" required>
    <!-- /// CAMBIO: agregué required -->

    <br><br>

    <input type="submit" value="Login">

</form>

<a href="registro.php">Crear cuenta</a>

</body>
</html>