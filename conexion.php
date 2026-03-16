<?php
$host = "localhost";
$usuario = "root";
$password = "";
$bd = "mercasuper";

$conexion = new mysqli($host, $usuario, $password, $bd);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$servidor = "mysql:host=$host;dbname=$bd";

try{
    $pdo = new PDO($servidor, $usuario, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")); /// CAMBIO: quitado username: y passwd:  /// CAMBIO: PDO:: en vez de PDO:


}catch (PDOException $e){ 
    echo "Error al conectar a la base de datos";
}
?>