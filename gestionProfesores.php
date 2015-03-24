<!DOCTYPE html>
<html>
<head>
	<title>Programa de asignación de cargas</title>
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

  include("header.php");

  if (!$loggedHeader) {
    header('Location: ../Asignacion/index.php');
  }

  $mostrarLista = false;
  $result = [];

  include('objetos/obj_profesor.php');
  include('controladores/controladorProfesores.php');
  $controlador = new controladorProfesores();


  if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $criterio = $_POST["criterio"];
    $valor = $_POST["valor"];

    if ($valor != "") {
      
      $shop = $controlador->retonarProfesor($criterio,$valor);

      if (count($shop) >= 1) {
        $mostrarLista = true;
      }
    }

  }

?>
		<div>
      <h2> Busqueda de Profesores </h2>
			<blockquote>
    			<p>A continuaci&oacute;n se muestran las opciones de b&uacute;squeda para localizar un profesor y realizar la gesti&oacute; necesaria</p>
  			</blockquote>
		</div>	
		</br>
		
    <div class="well well-lg">
      <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <label for="critero"> Criterio de b&uacute;squeda</label>
        <select class="form-control" name="criterio" id="criterio">
                <option>Nombre</option>
                <option>Primer Apellido</option>
                <option>Segundo Apellido</option>
                <option>Email</option>
        </select>


        <label for="name">Valor:</label>
        <input type="text" class="form-control" name="valor" id="valor">
        <br/><br/>
        <button type="submit" class="btn btn-primary">Buscar</button>

      </form>
    </div>
		<?php
      if ($mostrarLista) {
    
    ?>

    <div class="well well-lg">
			<table class="table table-condensed">
    		<thead>
      			<tr>
       				<th>Nombre</th>
       				<th>Apellido</th>
       				<th class="hidden-xs">Email</th>
   				</tr>
   			</thead>
   			<tbody>

   			<?php 
   				$x = 1;
   				foreach ($shop as $obj) : 
     				if ($x == 1) {
     					$x=0;
     					echo '<tr class="info">';     		
     				} else {
     					$x=1;
						echo '<tr>';
     				}
     		?>
       				<td><? echo $obj->name; ?></td>
       				<td><? echo $obj->apellido1; ?></td>
       				<td class="hidden-xs"><? echo $obj->email; ?></td>
     		</tr>
     		<?php endforeach; ?>
		        
    		</tbody>
  			</table>
      </div>
		<?php
      }

    ?>
		
	</div>
		
</body>
</html>