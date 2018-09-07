<?php

include "Conexion.php";

$Conexion = CrearConexion();

$SQL1 = "SELECT MAX(hora) AS hora FROM rutageo WHERE ID_Ruta=6";
$Resultado1 = Ejecutar($Conexion, $SQL1);

$SQL2 = "SELECT MIN(hora) AS hora FROM rutageo WHERE ID_Ruta=6";
$Resultado2 = Ejecutar($Conexion, $SQL2);

$Tupla1 = mysqli_fetch_array($Resultado1, MYSQLI_ASSOC);
$Tupla2 = mysqli_fetch_array($Resultado2, MYSQLI_ASSOC);

echo "Hola: " . $Tupla1['hora'];

$nInterval = strtotime($Tupla1['hora']) - strtotime($Tupla2['hora']);
$nInterval = $nInterval/60;

echo "Esto vale interval: " . $nInterval;


?>
