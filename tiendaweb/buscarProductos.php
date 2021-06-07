<?php

require './ClassProducto.php';

// Variables
$servername = "localhost";
$username = "php";
$password = "1234";
$dbname = "pruebas";
$busqueda = $_POST["ftext"];
$tipoBusqueda = $_POST["opcion"];

// Establecer conexión con la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
  die("Error de conexión: ".$conn->connect_error);
}



$resultado = $conn->query($sql);


$buscador = new Producto("1","1","1","1");

$buscador->buscar($busqueda,$tipoBusqueda,$conn);


$conn->close();

$conn->close();

?>
