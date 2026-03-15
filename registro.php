<?php
session_start();
require "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nombre, correo, password) VALUES (?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sss", $nombre, $correo, $password);

    if ($stmt->execute()) {
        echo "<script>alert('Usuario registrado correctamente'); window.location='login.php';</script>";
    } else {
        echo "<script>alert('Error: el correo ya existe');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Registro</title>
</head>
<body>
<h2>Registro</h2>

<form method="POST">
    <input type="text" name="nombre" placeholder="Nombre" required><br><br>
    <input type="email" name="correo" placeholder="Correo" required><br><br>
    <input type="password" name="password" placeholder="Contraseña" required><br><br>
    <input type="submit" value="Registrarse">
</form>

<a href="login.php">Ir a Login</a>
</body>
</html>