<?php
include "Conexion.php";
$Conexion = CrearConexion();
session_start();
$id_alerta = NULL;
$id_alerta = $_REQUEST["id_alerta"];

//$filtro = $_REQUEST['fil_nom'];

?>


<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Rutas-ULL</title>
  <link rel="stylesheet" type="text/css" href="css/index.css">
  <link rel="stylesheet" type="text/css" href="css/registrarse.css">
  <!--  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <script src="js/bootstrap.min.js"></script> -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
   <script>
   redirectURL = "index.php";
 function redireccionar() {
   setTimeout("location.href = redirectURL;", 4500);//Aqui debes poner a que pagina quieres redireccionar
 }
 </script>
</head>
<body onLoad="redireccionar()">

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
      <a class="navbar-brand" href="#">ULL-TRIP</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Rutas<span class="sr-only">(current)</span></a></li>
        <li><a href="#">Próximos eventos</a></li>
      </ul>

      <form class="navbar-form navbar-left" action= "./index.php" method="get">
        <div class="form-group">
          <input type="text" class="form-control" name="fil_nom" placeholder="Búsqueda de rutas...">
        </div>
        <button type="submit" class="btn btn-default">Buscar</button>
      </form>

      <ul class="nav navbar-nav navbar-right">
        <?php  if (isset($_SESSION["id_user"])){ ?>
          <li><a href="./subirruta.php"><span class="glyphicon glyphicon-arrow-up"></span> Subir Ruta</a></li>
          <li><a href="./logout.php"><span class="glyphicon glyphicon-remove"></span> Cerrar sesión</a></li>
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



  <div class="row ">


    <div class="col-md-3">
    </div>

    <div class="col-md-6 color">
      <br>
      <legend> &nbsp; Será redirigido en unos momentos...</legend>

      <?php if($id_alerta==0){

       ?>
      <h5>El registro ha fallado, vuelva a intentarlo con otros parámetros.</h5>
    <?php }else if($id_alerta==1){  ?>
      <h5>Registro completado.</h3>
    <?php }else if($id_alerta==2){ ?>
      <h5>Contraseña actualizada :)</h3>
    <?php }else if($id_alerta==3){ ?>
        <h5>Ha ocurrido un error, las contraseñas introducidas no son corectas.</h3>
    <?php }else if($id_alerta==4){ ?>
      <h5>Logueado correctamente.</h3>
    <?php }else if($id_alerta==5){ ?>
      <h5>Ha ocurrido un error, compruebe que los datos son correctos.</h5>
    <?php } else if($id_alerta==6){ ?>
          <h5>Cerrando sesión.</h5>
        <?php } ?>

    </div>

    <div class="col-md-3">
    </div>
  </div>

    <br>
    <br>

 </div>
</body>
</html>
