<?php
include "Conexion.php";
session_start();

function normaliza ($cadena){
    $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ
ßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
    $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuy
bsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
    $cadena = utf8_decode($cadena);
    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
    $cadena = strtolower($cadena);
    return utf8_encode($cadena);
}


$Conexion = CrearConexion();

$Titulo_ruta = $_REQUEST["titulo_ruta"];
$Dificultad = $_REQUEST["dificultad"];
$Descripcion = $_REQUEST["descripcion"];
/*$Tipo = $_REQUEST["tipo"];*/
//$aleatorio=mt_rand(1,1000000);

$SQL = "INSERT INTO rutas(Titulo_Ruta, Descripcion, Dificultad) VALUES ('".$Titulo_ruta."','".$Descripcion."', '".$Dificultad."')";
$Resultado = Ejecutar($Conexion, $SQL);


$SQL = "SELECT MAX(ID_Ruta) AS ID_Ruta FROM rutas";
$Resultado = Ejecutar2($Conexion, $SQL);
$Tupla = mysqli_fetch_array($Resultado ,MYSQLI_ASSOC);
$aux_id = $Tupla['ID_Ruta'];




$acumpos = 0.0;
$acumneg = 0.0;
$aux1 = "'";

$xml = simplexml_load_file($_FILES['rutagpx']['tmp_name']);

$d = 0.00;
$R = 6371;
$DtoR = 0.017453293;

$lat = (double)$xml->trk->trkseg->trkpt['lat'];
$lataux1 = $lat * $DtoR;
$lon = (double) $xml->trk->trkseg->trkpt['lon'];
$lonaux1 = $lon * $DtoR;
$auxant = $xml->trk->trkseg->trkpt->ele;

foreach ($xml->trk->trkseg->trkpt as $pt) {

  $lat = (double) $pt['lat'];
  $lon = (double) $pt['lon'];

  $ele = (float) $pt->ele;
  if($auxant < $ele){
    $acumpos = $acumpos + $ele - $auxant;
  }
  else{
    $acumneg = $acumneg + $auxant - $ele;
  }
  $auxant = $ele;

  $horaw = (string) $pt->time;
  $horaw = $aux1 . $horaw;
  $horaw = $horaw . $aux1;

  $lataux2 = $lat * $DtoR;
  $lonaux2 = $lon * $DtoR;
  $latres = $lataux1 - $lataux2;
  $lonres = $lonaux1 - $lonaux2;

  $a = pow(sin($latres/2), 2) + cos($lataux1) * cos($lataux2) * pow(sin($lonres/2), 2);
  $c = 2 * atan2(sqrt($a), sqrt(1-$a));
  $d = $d + $R * $c;

  $SQL = "INSERT INTO rutageo(ID_Ruta, latitud, longitud, elevacion, hora) VALUES ($aux_id, $lat, $lon, $ele, $horaw)";
  $return_consulta = Ejecutar2($Conexion, $SQL);

  $lataux1 = $lataux2;
  $lonaux1 = $lonaux2;
/*
  if ($return_consulta) {
    echo "Correcto ";
  }
  else {
    echo "Error " ;
  }*/

}

$d = $d/1.00;

$SQL = "SELECT MAX(hora) AS hora FROM rutageo where ID_ruta=$aux_id";
$Resultado1 = Ejecutar2($Conexion, $SQL);
$Tupla1 = mysqli_fetch_array($Resultado1 ,MYSQLI_ASSOC);

$SQL = "SELECT MIN(hora) AS hora FROM rutageo where ID_ruta=$aux_id";
$Resultado2 = Ejecutar2($Conexion, $SQL);
$Tupla2 = mysqli_fetch_array($Resultado2 ,MYSQLI_ASSOC);

$nInterval = strtotime($Tupla1['hora']) - strtotime($Tupla2['hora']);
$nInterval = $nInterval/60;

$SQL="UPDATE rutas set Duracion=$nInterval,  acumpos=$acumpos,  acumneg=$acumneg, distancia=$d where ID_Ruta=$aux_id";
$Resultado1 = Ejecutar2($Conexion, $SQL);

header('Location: ./index.php');
 ?>
