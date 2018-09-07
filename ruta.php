<?php
include "Conexion.php";
$Conexion = CrearConexion();
session_start();

$id_ruta = $_REQUEST["id_ruta"];

$SQL ="SELECT * FROM rutas where ID_Ruta=$id_ruta";
$Resultado = Ejecutar2($Conexion, $SQL);
$Tuplabase = mysqli_fetch_array($Resultado, MYSQLI_ASSOC);
?>

<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Rutas-ULL</title>
  <link rel="stylesheet" type="text/css" href="css/ruta.css">
  <link rel="stylesheet" type="text/css" href="css/estrellas.css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>

<!--  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <script src="js/bootstrap.min.js"></script> -->

 <!--<script type="text/javascript" src="js/ruta.js"></script> -->
  <script type="text/javascript">

  function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
      <?php

          $SQL = "SELECT * FROM rutageo where ID_Ruta=$id_ruta" ;
          $Resultado = Ejecutar2($Conexion, $SQL);
          $Tupla = mysqli_fetch_array($Resultado, MYSQLI_ASSOC);
      ?>
      zoom: 13,
      center: {lat: <?php echo $Tupla['latitud']?> , lng: <?php echo $Tupla['longitud']?>},
      mapTypeId: 'hybrid'
    });

    var startMarker = new google.maps.Marker({
      <?php
        echo "position: ";
        echo "{lat:". $Tupla['latitud'];
        echo ", lng:" . $Tupla['longitud'];
        echo "}, ";
      ?>
      map: map,
      title: 'Inicio'
    });

    var rutaCoordenadas =
      <?php
          echo "[";
          while($Tupla = mysqli_fetch_array($Resultado, MYSQLI_ASSOC)){
            echo "{lat:". $Tupla['latitud'];
            echo ", lng:" . $Tupla['longitud'];
            echo "}, ";
          }
        ?>
   ];
      var ruta = new google.maps.Polyline({
      path: rutaCoordenadas,
      geodesic: true,
      strokeColor: '#FF0000',
      strokeOpacity: 1.0,
      strokeWeight: 2
    });

    ruta.setMap(map);
  }
  </script>
</head>
<body>

  <div class="container">
    <nav class="navbar navbar-default">
   <div class="container-fluid">
     <div class="navbar-header">
       <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
         <span class="sr-only">Toggle navigation</span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
       </button>
       <a class="navbar-brand" href="./index.php">ULL-TRIP</a>
     </div>
     <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

       <ul class="nav navbar-nav">
         <li class="active"><a href="#">Rutas<span class="sr-only">(current)</span></a></li>
         <li><a href="./proximos_eventos.php">Próximos eventos</a></li>
       </ul>

       <form class="navbar-form navbar-left" action= "./index.php" method="get">
         <div class="form-group">
           <input type="text" class="form-control" name="fil_nom" placeholder="Búsqueda de rutas...">
         </div>
         <button type="submit" class="btn btn-default">Buscar</button>
       </form>

       <ul class="nav navbar-nav navbar-right">
         <?php  if (isset($_SESSION["id_user"])){ ?>
           <li><a href="./perfil.php"><span class="glyphicon glyphicon glyphicon-user"></span> Perfil</a></li>
           <li><a href="./subirruta.php"><span class="glyphicon glyphicon-arrow-up"></span> Subir Ruta</a></li>
           <li><a href="./logout.php"><span class="glyphicon glyphicon-remove"></span> Log out</a></li>
         <?php }else{ ?>
         <li><a data-toggle="modal"href="#signin_modal"><span class="glyphicon glyphicon-log-in"></span> Registrarse / Iniciar sesión</a></li>
       <?php } ?>
       </ul>

     </div>
   </div>
 </nav>

    <div class="modal fade" id="signin_modal" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" >&times;</button>
                <div class="row">


                  <div class="col-md-6">
                    <h4 class="">Iniciar sesión </h4>
                  </div>
                  <div class="col-md-4">
                    <h4 class="modal-title">Registrarse</h4>
                  </div>
              </div>
              </div>
              <div class="modal-body">

                <div class="row">
                <div class="col-md-6">
                <fieldset>
                  <form id="formlogin" action="autenticate.php"  onSubmit="login(); return false;" method="post">

                  <div class="form-group" class="center-block">
                     <label for="exampleInputEmail1">Email</label>
                     <input type="email" class="form-control" size="30" name="Email" id="Email" placeholder="Introduzca su email">
                  </div>

                   <div class="form-group" class="col-md-6">
                     <label for="exampleInputPassword1">Contraseña </label>
                     <input type="password" id="Password" class="form-control" name="Password" placeholder="Contraseña">
                   </div>
                   <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                   <h2 id="infologin"> </h2>
                 </form>
                </fieldset>
              </div>

              <div class="col-md-6">
              <fieldset>
                <form action="registro.php" method="post">

                <div class="form-group" class="center-block">
                   <label for="exampleInputEmail1">Email</label>
                   <input type="email" class="form-control" size="30" name="Email" placeholder="Introduzca Email">
                </div>
                <div class="form-group" class="col-md-6">
                  <label for="exampleInputname1">Nombre de usuario </label>
                  <input type="text" class="form-control" name="Username" placeholder="Contraseña">
                </div>

                 <div class="form-group" class="col-md-6">
                   <label for="exampleInputPassword1">Contraseña </label>
                   <input type="password"  class="form-control" name="Password"  placeholder="Contraseña">
                 </div>
                 <div class="form-group" class="col-md-6">
                   <label for="exampleInputPassword1">Repetir contraseña </label>
                   <input type="password"  class="form-control" name="Password" placeholder="Repetir contraseña">
                 </div>
                 <button type="submit" class="btn btn-primary">Registrarse</button>
               </form>
              </fieldset>
            </div>
              </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              </div>
            </div>

          </div>
        </div>

  <legend><?php echo $Tuplabase['Titulo_Ruta'] ?></legend>

  <div class="row">

    <div class="col-sm-12 class-col-xs-12 col-md-7">
      <div id="map" class="col-md-12 mapa" style="width: 100.5%">
        <script async defer src="http://maps.google.com/maps/api/js?key=AIzaSyDsPmeeOuH-9cv4rPlPYVU9B4T_TdKKYTw&callback=initMap"></script>
      </div>
    </div>

   <div class="col-md-5 col-sm-12 class-col-xs-12  caja_datos_ruta">
    <div class="datos_tec col-md-12">
      <h3>Datos ténicos</h3>
      <div class="caja_resumen_datos col-md-12">
        <p> <span class="glyphicon glyphicon-time"></span> Tiempo: <?php if($Tupla['Duracion']!=0){ echo $Tuplabase['Duracion'] ." min."; }
        else{ echo "DESCON" ;} ?>   &nbsp; &nbsp; &nbsp; <span class="glyphicon glyphicon-resize-horizontal"></span> Distancia: <?php echo $Tuplabase['distancia'] ?> km.</p>
    <!--  <p><span class="glyphicon glyphicon-resize-horizontal"></span> Distancia: <?php/* echo $Tuplabase['distancia'] */?> km.</p> -->
        <p> <span class="glyphicon glyphicon-arrow-up"></span> Desnivel positivo: <?php echo $Tuplabase['acumpos'] ?>m.</p>
        <p> <span class="glyphicon glyphicon-arrow-down"></span> Desnivel negativo: <?php echo $Tuplabase['acumneg'] ?>m.</p>
        <p><span class="glyphicon glyphicon-flash"></span> Dificultad: <?php echo $Tuplabase['Dificultad'] ?>.</p>
      </div>
    </div>

    <div class="desc_ruta col-md-12">
     <h3>Descripción</h3>
      <legend></legend>
      <div id="container">
        <p><?php echo $Tuplabase['Descripcion']?></p>
      </div>
     <legend></legend>
    </div>

    <div class="boton_descarga col-md-12">
      <a href="#" class="btn btn-warning btn-lg">
      <span class="glyphicon glyphicon-arrow-down"></span> Descargar </a>
    </div>

   </div>
   <div class="caja_comentarios col-md-12 col-sm-12 class-col-xs-12 ">
     <br>
     <ul class="nav nav-tabs">
           <li class="active">
             <a  href="#1" data-toggle="tab">Opiniones</a>
           </li>
           <li>
             <a href="#2" data-toggle="tab">Comentar</a>
           </li>
     </ul>

           <div class="tab-content ">
             <div class="tab-pane active" id="1">
              <?php  $SQL = "SELECT * FROM comentarios where ID_ruta=$id_ruta";
              $Resultado = Ejecutar2($Conexion, $SQL);
              if(mysqli_num_rows($Resultado)==0){
              ?>
              <div class="col-md-3">

              </div>
              <div class="col-md-6">
                <h3>Actualmente no existen comentarios de esta ruta.</h3>
                <?php if(isset($_SESSION["id_user"])){ ?>
                <h5>Comenta que te parece.</h5>
                <?php }else{?>
                  <h5>Inicie sesión para poder comentar.</h5>
                <?php } ?>
              </div>
              <div class="col-md-3">

              </div>
            <?php
          }
            else{
              while($Tuplacom = mysqli_fetch_array($Resultado ,MYSQLI_ASSOC)){
                $helpid = $Tuplacom['ID_user'];
                $SQL = "SELECT *  FROM usuario where ID_user = $helpid";
                $Resultado2 = Ejecutar2($Conexion, $SQL);
                $Tuplauser = mysqli_fetch_array($Resultado2 ,MYSQLI_ASSOC);
             ?>

              <div class="col-md-10">
                <h4><strong><?php echo $Tuplauser['User']?>:</strong> </h4>
              </div>
              <div class="col-md-2">
                <h4><?php echo $Tuplacom['fecha']?></h4>
              </div>
              <div class="col-md-12">
                <h4><?php $aux = $Tuplacom['Valoracion']; for ($i = 1; $i <= $aux; $i++){ echo "★";} ?></h4>
              </div>
              <div class="col-md-12">
                  <p> <?php echo "'" .$Tuplacom['Comentario'] ."'"?></p>
                  <legend></legend>
              </div>


             <?php }}?>
               <!--<p>Al contrario del pensamiento popular,  el texto de Lorem Ipsum no es simplemente texto aleatorio. Tiene sus raices en una pieza clásica de la literatura del Latin, que data del año 45 antes de Cristo, haciendo que este adquiera mas de 2000 años de antiguedad. Richard McClintock, un profesor de Latin de la Universidad de Hampden-Sydney en Virginia, encontró una de las palabras más oscuras de </p> -->
             </div>


             <div class="tab-pane" id="2">
               <div class="col-md-12 opinion">
                 <br>
                  <div class="col-md-3">

                  </div>
                  <div class="col-md-9">
                    <h3>¿Ha realizado la ruta? Agradeceríamos su opinión:</h3>
                    <?php if(!isset($_SESSION["id_user"])){ ?>
                      <h5>Inicie sesión para poder comentar.</h5>
                    <?php } ?>
                  </div>
                <?php if(isset($_SESSION["id_user"])){ ?>
                 <div class="col-md-4">
                </div>
                  <div class="col-md-8">
                    <form method="post" action="./opinar.php">
                      <input type="hidden" name="id_ruta" value='<?php echo $id_ruta ?>'>

                      <br>
                      <textarea type="text" rows="8" cols="60" name="opinion"  placeholder="Escriba aqui su opinión..."></textarea>
                     <br>
                      <p class="height">Valoración:

                       <span class="clasificacion">
                         <input id="radio1" type="radio" name="estrellas" value="5" ><!--
                       --><label for="radio1">★</label><!--
                     -->  <input id="radio2" type="radio" name="estrellas" value="4" ><!--
                       --><label for="radio2">★</label><!--
                       --><input id="radio3" type="radio" name="estrellas" value="3"><!--
                       --><label for="radio3">★</label><!--
                       --><input id="radio4" type="radio" name="estrellas" value="2"><!--
                       --><label for="radio4">★</label><!--
                       --><input id="radio5" type="radio" name="estrellas" value="1"><!--
                       --><label for="radio5">★</label>
                      </span>

                     </p>
                     <br>
                      <div class="col-md-2">

                      </div>

                      <div class="col-md-4">
                          <input type="submit" class="btn btn-warning btn-lg" value="Enviar">
                      </div>

                      <div class="col-md-6">
                      </div>

                 </form>
                    <br>
                    <br>
                    <br>
                 </div>

               <?php } ?>


                </div>
                <div class="col-md-12">
                </div>

               </div>
             </div>
           </div>
 </div>


 </div>
 <br>
 <br>
</body>
</html>
