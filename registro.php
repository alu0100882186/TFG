<?php

	include "Conexion.php";

	session_start();

	$Conexion = CrearConexion();

	$usuario = $_REQUEST["Username"];
	$email = $_REQUEST["Email"];
	$password = $_REQUEST["Password"];
	$provincia = $_REQUEST["provincia"];
	if(empty($_REQUEST["fecha"]))
   {
		 $fecha = NULL;
		 // query string had param set to nothing ie ?param=&param2=something
   }
	 else{
		 	$fecha = $_REQUEST["fecha"];
	 }


	if(empty($_REQUEST["sexo"]))
   {
		 $sexo = NULL;
		 // query string had param set to nothing ie ?param=&param2=something
   }
	 else{
		 	$sexo = $_REQUEST["sexo"];
	 }

	$SQL = "INSERT INTO usuario(User, Password, Email,  Sexo, provincia, Fecha) VALUES ('$usuario', '$password', '$email',  '$sexo', '$provincia', '$fecha')";
	$Resultado = Ejecutar($Conexion, $SQL);
	if(!$Resultado){
		header('Location: ./alertas.php?id_reg=0');
	}
	else{
		header('Location: ./alertas.php?id_reg=1');
	}



?>
