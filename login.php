
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

</head>

<body>
	<div class="container">
<?php

 session_start(); //importante arrancar el session luego de incluir los objetos, sino tira un error que no conoce el objeto a crear

 $loginStatus = 0;
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      $tipoUsuario = $_POST["tipoUser"];

      if (strcmp($tipoUsuario, 'Administrador') == 0) {
          $_SESSION['logged_user']= "elizondo1288@hotmail.com super";
      }else{
          $_SESSION['logged_user']= "elizondo1288@hotmail.com profesor";
      }
   
      header('Location: ../Asignacion/profesores.php'); 
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
                      <p>El Grupo a registrar ya existe </p>
                      </div>';
              } elseif ($loginStatus == 3) {
                echo '<div class="alert alert-danger" role="alert">
                      <p>Error al registrar el grupo </p>
                      </div>';
              }   

        ?>
          <h3>Bienvenido!</h3>
          <p>Por favor ingrese su informaci&oacute;n: </p><br/>
          <div class="form-group">
              <label for="name">Usuario:</label>
              <input type="name" class="form-control" name="ideGrupo" id="ideGrupo"/>

              <label for="name">Password:</label>
              <input type="name" class="form-control" name="ideGrupo" id="ideGrupo"/>

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