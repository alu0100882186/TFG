<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ULL-Routing</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
      <a class="navbar-brand" href="#">ULL-Routing</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Rutas<span class="sr-only">(current)</span></a></li>
        <li><a href="#">Próximos eventos</a></li>
      </ul>
      <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Búsqueda de rutas...">
        </div>
        <button type="submit" class="btn btn-default">Buscar</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a data-toggle="modal"href="#signin_modal"><span class="glyphicon glyphicon-user"></span> Registrarse</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Iniciar sesión</a></li>
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

  <div class="row">
    <div class="col-md-12">
      <form class="form-horizontal" method="post" action="./upload.php" enctype="multipart/form-data">
          <fieldset>
              <legend>Introducir una nueva ruta.</legend>

              <div class="form-group">
                  <label class="col-md-4 control-label" for="Titulo_ruta">Título de la ruta</label>
                  <div class="col-md-4">
                      <div class="input-group">
                          <div class="input-group-addon">
                              <i class="fa fa-pencil" aria-hidden="true"></i>
                          </div>
                          <input id="Name (Full name)" name="titulo_ruta" type="text" placeholder="Título" class="form-control input-md">
                      </div>
                  </div>
              </div>
                              <!--
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="Fotos_portada"><i class="fa fa-picture-o" aria-hidden="true"></i> Foto de portada</label>
                                        <div class="col-md-4">
                                            <input id="Upload photo" name="fotoportada" class="input-file" type="file">
                                        </div>
                                    </div>
                                  -->
                  <div class="form-group">
                      <label class="col-md-4 control-label" for="Upload photo"><i class="fa fa-picture-o" aria-hidden="true"></i> Ruta en formato GPX</label>
                      <div class="col-md-4">
                          <input id="Upload photo" class="input-file" name="rutagpx"  type="file" >
                      </div>
                  </div>

                  <form class="form-group">
                      <label class="col-md-4 control-label"><i class="" aria-hidden="true"></i> Dificultad de la ruta </label>
                      <label class="radio-inline">
                         <input type="radio" name="dificultad" value="baja">Baja
                       </label>
                      <label class="radio-inline">
                        <input type="radio" name="dificultad" value="media">Media
                      </label>
                      <label class="radio-inline">
                       <input type="radio" name="dificultad" value="alta">Alta
                      </label>
                  </form>

              <br>
              <br>
              <br>
                    <!-- Textarea -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="Overview (max 200 words)">Descripción de la ruta</label>
                        <div class="col-md-4">
                            <textarea class="form-control" rows="10" id="Overview (max 200 words)" name="descripcion"></textarea>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4">
                            <button class="btn btn-success"><span class="glyphicon glyphicon-arrow-up"></span> Subir una nueva ruta</button>
                        </div>
                    </div>

                </fieldset>
            </form>
    </div>



    </div>

  </div>
    <br>
    <br>

</body>
</html>
