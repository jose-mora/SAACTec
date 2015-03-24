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
?>
		<div>
			<h2> Acerca de.. </h2>
			<blockquote>
    			<p>En esta secci&oacute;n se encuentra la informaci&oacute;n de los desarrolladores</p>
  			</blockquote>
		</div>	
		</br>
		
		<div align="center">
			<div class="row">
				<div class="col-sm-6 col-md-4">
    				<div class="thumbnail">
      					<img height="80px" width="80px" src="img/user-female.png">
      					<div class="caption">
        					<h3>Gabriela Loaiza Mora	</h3>
        					<p>Madre de Mat&iacute;as/ Estudiante de maestr&iacute;a</p>
        					<p>user@correo.com</p>
        					<!--p><a href="#" class="btn btn-primary" role="button">Button</a--> 
      					</div>
    				</div>
    			</div>
  				<div class="col-sm-6 col-md-4">
    				<div class="thumbnail">
      					<img height="80px" width="80px" src="img/user-male.png">
      					<div class="caption">
        					<h3>Erick Mora D&iacute;az</h3>
        					<p>Estudiante de maestr&iacute;a</p>
        					<p>user@correo.com</p>
      					</div>
    				</div>
    			</div>
    			<div class="col-sm-6 col-md-4">
    				<div class="thumbnail">
      					<img height="80px" width="80px" src="img/user-male.png">
      					<div class="caption">
        					<h3>Jonathan Mendez Baltodano</h3>
        					<p>Estudiante de maestr&iacute;a</p>
        					<p>jmendezb@yahoo.com</p>
      					</div>
    				</div>
    			</div>
    			<div class="col-sm-6 col-md-4">
    				<div class="thumbnail">
      					<img height="80px" width="80px" src="img/user-male.png">
      					<div class="caption">
        					<h3>Esteban Elizondo Camacho</h3>
        					<p>Estudiante de maestr&iacute;a</p>
        					<p>elizondo1288@gmail.com</p>
      					</div>
    				</div>
    			</div>
    			
  			</div>
		</div>
		
	</div>
		
</body>
</html>