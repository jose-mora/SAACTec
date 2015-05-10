
<!DOCTYPE html>
<html>
    <head>
        <?php
        include ("tituloPagina.php");
        ?>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="css/customStyle.css">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php
        header('Content-Type: text/html; charset=UTF-8');
        ?>

    </head>

    <body>
        <div class="container">
            <?php
            session_start(); //importante arrancar el session luego de incluir los objetos, sino tira un error que no conoce el objeto a crear

            $loginStatus = 0;
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                include('objetos/obj_usuario.php');
                include('controladores/controladorUsuarios.php');
                  
                $usuario = $_POST["txtUsuario"];
                $contrasena = $_POST["txtContrasena"];
                $tipoUsuario = $_POST["tipoUser"];
                $alias="";
                $controlador = new controladorUsuarios();

                //Validar que haya escrito usuario y contraseá
                if ((strlen($usuario)>0) && (strlen($contrasena)>0)){
                    $user = $controlador->retornarUsuario($usuario,$contrasena,$tipoUsuario);
                      //si hay un array es porque encontró el usuario
                    if (count($user)>0){
                        $alias = $user[0]->usuario;
                        $tipoUsuario = $user[0]->tipoUsuario;
                        $_SESSION['logged_user']= $alias.' '.$tipoUsuario;
                        header('Location: ../Asignacion/profesores.php'); 
                      }
                      //Código 1 indica que no hubo coincidencia de usuario
                      else {$loginStatus = 1;}
                  }
                  //Indica que no se llenaron todos los campos
                  else{ $loginStatus = 2;}
            }
            include("header.php");
            ?>
            <div class="jumbotron">
                <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

<?php
            if ($loginStatus == 2) {
                echo '<div class="alert alert-danger" role="alert">
                      <p>Se deben llenar todos los campos </p>
                      </div>';
              }elseif ($loginStatus == 1) {
                echo '<div class="alert alert-danger" role="alert">
                      <p>El usuario o la contrasena son inválidos, o su usuario está deshabilitado</p>
                      </div>';
              }   
?>
                    <h3>Bienvenido!</h3>
                    <p>Por favor ingrese su informaci&oacute;n: </p><br/>
                    <div class="form-group">
                        <label for="name">Usuario:</label>
                        <input type="name" class="form-control" name="txtUsuario" id="txtUsuario"/>
                        <label for="name">Password:</label>
                        <input type="password" class="form-control" name="txtContrasena" id="txtContrasena"/>

                        <label for="name">Tipo Usuario:</label>
                        <select class="form-control" name="tipoUser" id="tipoUser">
                            <option>Administrador</option>
                            <option>Profesor</option>
                        </select>

                        <br/><br/>
                        <button type="submit" class="btn btn-primary">Ingresar</button>
                        <a href="crearCuenta.php" class="btn btn-primary">Registrarse</a>
                    </div>
                </form>
            </div>    

    </body>
</html>