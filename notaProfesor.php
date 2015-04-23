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

  include("header.php");

  if (!$loggedHeader) {
    header('Location: ../Asignacion/index.php');
  }

  $validateFlag = FALSE;
  $result = [];

  include('objetos/obj_profesor.php');
  include('controladores/controladorProfesores.php');
  $controlador = new controladorProfesores();

  if ($_SERVER['REQUEST_METHOD'] == 'GET')
  {
    if(!empty($_GET["etype"])){

    }
    if(!empty($_GET["objDes"])){
      
    }
    if(!empty($_GET["objActi"])){
      
    }
    if(!empty($_GET["objUpdate"])){
      
    }

  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $operation = $_POST["operation"];


    if ($operation == "") {  //si es regitrar sede

    }
    if ($operation == "") {  //si es regitrar curso

    }

  }

?>
		<div>
      <h2> Notas de Profesor </h2>
			<blockquote>
    			<p>Se muestran la lista de las últimas 10 notas del profesor, con la posibilidad de agregar nueva o anular </p>
  			</blockquote>
		</div>	
		</br>
		
    <div class="well well-lg">
      <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

        <label for="critero"> Modalidad</label>
        <select class="form-control" name="modalidad" id="modalidad">
                <option>Semestre</option>
                <option>Cuatrimestre</option>
                <option>Bimestre</option>
        </select>

        <label for="critero"> N&uacute;mero</label>
        <select class="form-control" name="tiempo" id="tiempo">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
        </select>


        <label for="name">Nota:</label>
        <input type="text" class="form-control" name="nota" id="nota">
        <br/><br/>

        <input type="hidden" id="operation" name="operation" value="agregar_nota">
        <button type="submit" class="btn btn-primary">Agregar</button>

      </form>
    </div>
		<br/>

    <div class="well well-lg">
      <h3>Notas anteriores</h3>
      <label for="curso">Notas:</label>
			
      <table class="table table-condensed">
    		<thead>
      			<tr>
       				<th>Nota</th>
       				<th>Período</th>
              <th>Anular</th>
   				</tr>
   			</thead>
   			<tbody>

   			<tr class="info">
              <td>80</td>
              <td>2 Semestre 2014</td>
              <td><? echo "<a href='notaProfesor.php?anularNota=1' class='btn btn-primary gestionBoton'> Anular </a> "; ?></td>

        </tr>
        <tr>
              <td>75</td>
              <td>1 Semestre 2014</td>
              <td><? echo "<a href='notaProfesor.php?anularNota=1' class='btn btn-primary gestionBoton'> Anular </a> "; ?></td>
        </tr>
		          
    		</tbody>
  			</table>
    </div>

   
      
    </div>
	</div>
		
</body>
</html>