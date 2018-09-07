<?php
include "Conexion.php";
session_start();
$Conexion = CrearConexion();

$nueva = $_REQUEST["nueva"];
$actual = $_REQUEST["actual"];
$repetir = $_REQUEST["repetir"];

$aux_user = $_SESSION["id_user"];

if($nueva == $repetir){

  $SQL = "SELECT Password FROM usuario WHERE ID_User = $aux_user ";
  $Resultado = Ejecutar2($Conexion, $SQL);
  $Tupla = mysqli_fetch_array($Resultado ,MYSQLI_ASSOC);
  if($Tupla['Password'] == $actual){
    $SQL = "UPDATE usuario SET Password= '$nueva'  WHERE ID_user = $aux_user";
    $Resultado = Ejecutar($Conexion, $SQL);
    header('Location: ./alertas.php?id_reg=2');
  }else{
    header('Location: ./alertas.php?id_reg=3');
  }

}else{
  header('Location: ./alertas.php?id_reg=3');
}

 ?>
