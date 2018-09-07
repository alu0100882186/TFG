<?php
include "Conexion.php";
  session_start();
  $Conexion = CrearConexion();


  $email = $_REQUEST["Email"];
  $password = $_REQUEST["Password"];

  $datos = new stdClass();

  $SQL = " select * from usuario where Email = '$email' and Password = '$password'";

  $Resultado = mysqli_query($Conexion, $SQL);
  $Tupla = mysqli_fetch_array($Resultado ,MYSQLI_ASSOC);
  if ($Tupla["ID_user"] != ""){
    $_SESSION["id_user"] = $Tupla["ID_user"];
    $_SESSION["username"] = $Tupla["User"];
    $_SESSION["email"] = $Tupla["Email"];
    //  $_SESSION["Tipo"] = $Tupla["Tipo"];
    $datos->login = "logueado";
    header('Location: ./alertas.php?id_alerta=4');
  }
  else{
    $datos->login = "nologueado";
    header('Location: ./alertas.php?id_alerta=5');
  }

  //Devolvemos el array pasado a JSON como objeto
  echo json_encode($datos, JSON_FORCE_OBJECT);

?>
