<?php
include "Conexion.php";
$Conexion = CrearConexion();
session_start();

//$filtro = $_REQUEST['fil_nom'];

?>


<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ULL-Routing</title>
  <link rel="stylesheet" type="text/css" href="css/index.css">
  <link rel="stylesheet" type="text/css" href="css/registrarse.css">
  <!--  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <script src="js/bootstrap.min.js"></script> -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
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
      <a class="navbar-brand" href="./index.php">ULL-Routing</a>
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
      <legend> &nbsp; Registro</legend>
      <fieldset>
        <form action="registro.php" method="post">

        <div class="form-group" class="center-block">
           <label for="exampleInputEmail1">Email</label>
           <input type="email" class="form-control" size="30" name="Email" placeholder="Introduzca Email" required>
        </div>
        <div class="form-group" class="col-md-6">
          <label for="exampleInputname1">Nombre de usuario </label>
          <input type="text" class="form-control" name="Username" placeholder="Nombre de usuario" required>
        </div>

        <label for="">Fecha de nacimiento: </label>
        <input type="date" name="fecha" required>
        <br>
        <br>
        <label for="">Provincia: </label>

        <select name="provincia" required>
         <option value="">- selecciona -</option>
         <option value="15">A coruña</option>
         <option value="1">Álava</option>
         <option value="2">Albacete</option>
         <option value="3">Alicante</option>
         <option value="4">Almería</option>
         <option value="33">Asturias</option>
         <option value="5">Ávila</option>
         <option value="6">Badajoz</option>
         <option value="7">Baleares</option>
         <option value="8">Barcelona</option>
         <option value="9">Burgos</option>
         <option value="10">Cáceres</option>
         <option value="11">Cádiz</option>
         <option value="39">Cantabria</option>
         <option value="12">Castellón</option>
         <option value="51">Ceuta</option>
         <option value="13">Ciudad Real</option>
         <option value="14">Córdoba</option>
         <option value="16">Cuenca</option>
         <option value="99">Extranjero</option>
         <option value="17">Girona</option>
         <option value="18">Granada</option>
         <option value="19">Guadalajara</option>
         <option value="20">Guipúzcoa</option>
         <option value="21">Huelva</option>
         <option value="22">Huesca</option>
         <option value="23">Jaén</option>
         <option value="26">La rioja</option>
         <option value="35">Las palmas</option>
         <option value="24">León</option>
         <option value="25">Lleida</option>
         <option value="27">Lugo</option>
         <option value="28">Madrid</option>
         <option value="29">Málaga</option>
         <option value="52">Melilla</option>
         <option value="30">Murcia</option>
         <option value="31">Navarra</option>
         <option value="32">Ourense</option>
         <option value="34">Palencia</option>
         <option value="36">Pontevedra</option>
         <option value="37">Salamanca</option>
         <option value="38">Santa cruz de tenerife</option>
         <option value="40">Segovia</option>
         <option value="41">Sevilla</option>
         <option value="42">Soria</option>
         <option value="43">Tarragona</option>
         <option value="44">Teruel</option>
         <option value="45">Toledo</option>
         <option value="46">Valencia</option>
         <option value="47">Valladolid</option>
         <option value="48">Vizcaya</option>
         <option value="49">Zamora</option>
         <option value="50">Zaragoza</option>
       </select>


       <br>
       <br>
       <label>Sexo:</label>
       <br>
       <input type="radio" name="sexo" value="hombre" checked="checked" required> Hombre

       <input type="radio" name="sexo" value="mujer" required>  Mujer

       <br>
       <br>

         <div class="form-group" class="col-md-6">
           <label for="exampleInputPassword1">Contraseña </label>
           <input type="password"  class="form-control" name="Password"  placeholder="Contraseña" required>
         </div>
         <div class="form-group" class="col-md-6">
           <label for="exampleInputPassword1">Repetir contraseña </label>
           <input type="password"  class="form-control" name="Password" placeholder="Repetir contraseña" required>
         </div>

         <button type="submit" class="btn btn-primary">Registrarse</button>
       </form>
      </fieldset>
    </div>
    <div class="col-md-3">

    </div>
  </div>

    <br>
    <br>

 </div>
</body>
</html>
