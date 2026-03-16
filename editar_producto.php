<?php
require "conexion.php";

$id = $_GET["id"];

$sql = "SELECT * FROM productos WHERE id=$id";
$resultado = $conexion->query($sql);
$producto = $resultado->fetch_assoc();

if($_SERVER["REQUEST_METHOD"]=="POST"){

$nombre = $_POST["nombre"];
$precio = $_POST["precio"];

$sql = "UPDATE productos SET nombre='$nombre', precio='$precio' WHERE id=$id";

$conexion->query($sql);

header("Location: productos.php");

}
?>

<h2>Editar producto</h2>

<form method="POST">

<input type="text" name="nombre" value="<?php echo $producto["nombre"]; ?>"><br><br>

<input type="number" name="precio" value="<?php echo $producto["precio"]; ?>"><br><br>

<button type="submit">Actualizar</button>

</form>