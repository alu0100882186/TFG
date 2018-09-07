<?php
include "Conexion.php";
session_start();
$Conexion = CrearConexion();


$ventajas = $_REQUEST["ventajas"];
$desventajas = $_REQUEST["desventajas"];
$opinion = $_REQUEST["opinion"];
$estrellas = $_REQUEST["estrellas"];
$ID_Ruta = $_REQUEST["id_ruta"];
$id = $_SESSION['id_user'];

$fecha = date(' j-m-y');

$SQL = "INSERT INTO comentarios(ID_ruta, ID_user, Comentario, Ventaja, Desventaja, Valoracion, fecha) VALUES ($ID_Ruta, $id,  '".$opinion."', '".$ventajas."', '".$desventajas."', $estrellas, '".$fecha."' )";
$Resultado = Ejecutar($Conexion, $SQL);

header('Location: ./ruta.php?id_ruta='.$ID_Ruta);
