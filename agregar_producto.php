<?php
require "conexion.php";

if($_SERVER["REQUEST_METHOD"]=="POST"){

$nombre = $_POST["nombre"];
$precio = $_POST["precio"];
$descripcion = $_POST["descripcion"];

$sql = "INSERT INTO productos(nombre,precio,descripcion)
VALUES('$nombre','$precio','$descripcion')";

$conexion->query($sql);

header("Location: productos.php");

}
?>

<h2>Agregar Producto</h2>

<form method="POST">

<input type="text" name="nombre" placeholder="Nombre"><br><br>

<input type="number" name="precio" placeholder="Precio"><br><br>

<textarea name="descripcion" placeholder="Descripción"></textarea><br><br>

<button type="submit">Guardar</button>

</form>