<!DOCTYPE html>
<html>
    <head>
      <title>Programa de asignación de cargas</title>
      <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
      <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
      <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
      <link rel="stylesheet" type="text/css" href="css/customStyle.css">
      <script src="js/functions.js"></script> 
      <meta name="viewport" content="width=device-width, initial-scale=1">

    </head>
<body>
  <div class="container">
    <?php  ?>
<?php
  session_start();
  include("header.php");

  if (!$loggedHeader) {
    header('Location: ../Asignacion/index.php');
  }

  $validateFlag = FALSE;
  $successFlag = FALSE;
  $emptyAmmount = 0;

  include('objetos/obj_profesor.php');
  include('controladores/controladorProfesores.php');
  $controlador = new controladorProfesores();


  if ($_SERVER['REQUEST_METHOD'] == 'POST') 
  {
    $username =  test_input($_POST["name"]);
    $lastname = test_input($_POST["lastname"]);
    $lastname2 = test_input($_POST['lastname2']);
    $email = test_input($_POST["email"]);
    $tel = test_input($_POST["tel"]);

    if ( strlen( $username ) <= 0 ){
      $validateFlag = TRUE;
      $emptyAmmount++;
    }
    if ( strlen( $lastname ) <= 0 ){
      $validateFlag = TRUE;
      $emptyAmmount++;
    }
    if ( strlen( $lastname2 ) <= 0 ){
      $validateFlag = TRUE;
      $emptyAmmount++;
    }
    if ( strlen( $email ) <= 0 ){
      $validateFlag = TRUE;
      $emptyAmmount++;
    }
    if ( strlen( $tel ) <= 0 ){
      $validateFlag = TRUE;
      $emptyAmmount++;
    }

    if (!$validateFlag) { //if the validation passes

      $prof = new obj_profesor(0,$username,$lastname,$lastname2,$email,$tel); 
      $resultado =  $controlador->registrarProfesores($prof);


      if ($resultado > 0) {
        $validateFlag = TRUE;
        $successFlag = FALSE;
      }else{
        $validateFlag = FALSE;
        $successFlag = TRUE;
      }

      //$_SESSION['profesor']= $prof;
      //header('Location: ../Asignacion/profesores.php');   

    }else{

      //empty fields detected
      //if its 4, all of the fields were empty, so the user is reaching the screen
      if ($emptyAmmount == 5) {
          $validateFlag = FALSE;
        }  
    }
  }

  function test_input($data) {//clean the data from the fields

    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
  }
  
?>

		<div>
			<blockquote>
    			<p>Secci&oacute;n de registro de profesores, por favor ingresar los datos solicitados</p>
  			</blockquote>
		</div>	
    <div class="well well-lg">
      <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <?php
          if ($validateFlag) {
            echo '<div class="alert alert-danger" role="alert">
                    <p>Se deben llenar todos los campos </p>
                  </div>';
          } 

          if ($successFlag) {
              echo '<div class="alert alert-success" role="alert">
                    <p>Profesor registrado con &eacute;xito </p>
                  </div>';
          } 
        ?>
        <h3>Registro de Profesores</h3>
        <div class="form-group">
          <label for="name">Nombre:</label>
          <input type="text" class="form-control" name="name" id="name">
        </div>
        <div class="form-group">
          <label for="lastname">Primer Apellido:</label>
          <input type="text" class="form-control" name="lastname" id="lastname">
        </div>
        <div class="form-group">
          <label for="lastname">Segundo Apellido:</label>
          <input type="text" class="form-control" name="lastname2" id="lastname2">
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" class="form-control" name="email" id="email">
        </div>
        <div class="form-group">
          <label for="tel">Telefono:</label>
          <input type="telephone" class="form-control" id="tel" name="tel">
        </div>
        <button type="button" class="btn btn-primary" onclick="goBack();"> Atras </button>
        <button type="submit" class="btn btn-primary">Registrar</button>
          
      </form>
			
  	</div>
		</div>
		
	</div>
		
</body>
</html>