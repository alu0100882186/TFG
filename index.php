<?php
include "Conexion.php";
$Conexion = CrearConexion();
session_start();
error_reporting(E_ALL ^ E_NOTICE);
$filtro = $_REQUEST['fil_nom'];

?>


<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Rutas-Routing</title>
  <link rel="stylesheet" type="text/css" href="css/index2.css">
  <!--  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <script src="js/bootstrap.min.js"></script> -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>

   <script type="text/javascript">
   function createEllipsis(){
     var containerHeight = $("#container").height();
     var $text = $("#container p");

     while ( $text.outerHeight() > containerHeight ) {
      $text.text(function (index, text) {
          return text.replace(/\W*\s(\S)*$/, '...');
     });
    }
   }
   </script>

</head>
<body onload="createEllipsis()">

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
                  <form id="formlogin" action="autenticar_user.php"  onSubmit="login(); return false;" method="post">

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
                <h4>¿Aún no estás registrado?</h4>
                <div class="col-md-1">

                </div>
                <div class="col-md-8">
                  <a class="btn btn-primary btn-lg" href="./registrarse.php" role="button">Registrarse</a>
                </div>
                 <div class="col-md-3">

                 </div>
            </div>
              </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              </div>
            </div>

          </div>
        </div>



  <br>

  <div class="row">
    <div class="col-md-12">
      <div class="informacion">
        <h3>Bienvenidos a ULL-Routing</h4>
          <br>
        <p>- Aquí tendrás la posibilidad de compartir tus entrenos o rutas con el resto de usuarios, puedes buscar las rutas que más se ajusten a tus características (disponemos de una búsqueda avanzada), descargarlas para importarla en tu smartphone o smartwatch y además valorarlas para ayudar al resto de corredores.</p>
        <br>
        <br>
      </div>

    </div>

  </div>
  <br>
  <br>
  <legend>Rutas destacadas</legend>
  <div class="row">
    <?php
    if($filtro == ""){
      $SQL = "SELECT * FROM rutas";
    }
    else{
      $SQL = "SELECT * FROM rutas WHERE Titulo_Ruta LIKE '%".($filtro)."%' ";
    }
    $Resultado = mysqli_query($Conexion, $SQL);
    while ($Tupla = mysqli_fetch_array($Resultado ,MYSQLI_ASSOC)){
     ?>
<a class"enlace_ruta" href='./ruta.php?id_ruta=<?php echo $Tupla['ID_Ruta']?>'>
  <div class="col-sm-12 class-col-xs-12 col-md-4">
  <div class="col-md-4 exterior" style="width: 105%">
    <div class="interior1" id="caja">
    <h3 class="titulo_ruta"><?php echo $Tupla['Titulo_Ruta']?></h3>
    <div class="caja_foto">
      <img class="img-fluid imagen2" src="http://www.wildcanarias.com/wp-content/uploads/2013/10/TCI-221-660x400.jpg" alt="ruta anaga">
    </div>
     <!-- "http://www.asociacioncastanoynogal.com/blog/wp-content/uploads/2010/11/sendero.jpg    http://www.wildcanarias.com/wp-content/uploads/2013/10/TCI-221-660x400.jpg-->
      <div class="texto_ruta" id="container" >
        <p> <?php echo $Tupla['Descripcion']?></p>
      </div>
        <div class="row datos">
        <div class="col-md-4 col-sm-4 col-xs-4"><span class="glyphicon glyphicon-time"><?php if($Tupla['Duracion']!=0){ echo " ~" .$Tupla['Duracion'] . "min."; }else{ echo " DESCON"; }?></span></div>
        <div class="col-md-4 col-sm-4 col-xs-4"><span class="glyphicon glyphicon-resize-horizontal"> <?php echo $Tupla['distancia']?> km</span></div>
        <div class="col-md-4 col-sm-4 col-xs-4"><span class="glyphicon glyphicon-flash"> <?php echo $Tupla['Dificultad']?></span></div>
        </div>

      </div>
    </div>
    </div>
  </a>
    <?php } ?>

  </div>

    <br>
    <br>

    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
          <div class="item active">
            <img src="https://www.tenerifebluetrail.com/assets/slide/5b1ae37596ddb.jpg" alt="Publicidad Blue Trail" style="width:100%;">
          </div>

          <div class="item">
            <img src="https://www.tenerifebluetrail.com/assets/slide/5b1ae37596ddb.jpg" alt="Publicidad Blue Trail" style="width:100%;">
          </div>

          <div class="item">
            <img src="https://www.tenerifebluetrail.com/assets/slide/5b1ae37596ddb.jpg" alt="Publicidad Blue Trail" style="width:100%;">
          </div>
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>

 </div>
</body>
</html>
