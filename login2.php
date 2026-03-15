<?php

$host = "localhost";      // Siempre localhost en XAMPP
$usuario = "root";        // Usuario por defecto
$password = "";           // Vacío por defecto en XAMPP
$bd = "usuarios";    // ← Nombre de tu BD

$conexion = new mysqli($host, $usuario, $password, $bd);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

echo "Conexión exitosa";

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MercaSuper</title>
    <link rel="stylesheet" href="Style.css">
</head>
<body>

    <div class="container">
        <div class="info">
            <p class="txt-1">gracias por visitranos</p>
            <h2>Mercasuper</h2>
            <hr/>
            <p class="txt-2">
                Bienvenido a la gran tienda de Merca Super
            </p>
        </div>

        <form class="form">
            <h2>Login</h2>
            <img src="imagenes/logo.png" alt="Logo" width="150" height="100">
            <p>Inicia sesión para realizar tus compras</p>

            <div class="inputs">
                <input type="email" id="email" class="box" placeholder="Ingrese su correo">
                <input type="password" id="password" class="box" placeholder="Ingrese su contraseña">
                <a href="error">¿Olvidaste tu contraseña?</a>
                <input type="submit" value="Login" class="submit">
            </div>
        </form>
    </div>

<script>
document.addEventListener("DOMContentLoaded", function() {

    const formulario = document.querySelector("form");

    formulario.addEventListener("submit", function(e) {
        e.preventDefault();

        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;

        console.log("Email:", email);
        console.log("Password:", password);

        fetch("http://localhost:3000/login", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                email: email,
                password: password
            })
        })
        .then(res => res.json())
        .then(data => {
            console.log("Respuesta:", data);

            if (data.mensaje === "Login recibido correctamente") {
                window.location.href = "productos.html";
            } else {
                alert("Error en login");
            }
        })
        .catch(error => {
            console.error("ERROR FETCH:", error);
        });

    });

});
</script>
</body>
</html>

