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

  $shop = array(
      array("John Joaquin","Fernandez Lopez","johnFernandez@example.com","8834-2134"),
      array("Mary","Moe","mary@example.com","8834-2134"),
      array("July","Dooley","july@example.com","8834-2134" ),
    ); 

?>   
    <div>
      <blockquote>
          <p>A continuaci&oacute;n se muestra la lista de los profesores registrados en el sistema junto con informaci&oacute;n de contacto del mismo. Si el profesor a buscar no se encuentra en la lista, por favor registrarlo en el Sistema de Asignaci&oacute;n de Cargas</p>
      </blockquote>
    </div>  
    </br> 
    <div class="jumbotron">
      <h2>Bienvenidos!</h2>
      <p>En este sistema se pueden encontrar las siguientes funciones o secciones para el desarrollo de la asignaci&oacute;n de cargas automaticas:</p>
      <ul>
        <li><b>Profesores:</b> Secci&oacute;n que permite realizar la busqueda para añadir evaluaciones y el registro de profesores en el sistema.</li></br>
        <li><b>Preferencias:</b> Secci&oacute;n que permite registrar las preferencias del profesor con respecto a grupos y fechas.</li></br>
        <li><b>Consultas:</b> Toda la información en reportes a realizar en el sistema.</li></br>
        <li><b>Asignar Cargas:</b> Secci&oacute;n encargada de realizar todo el analisis de cargas y dar los resultados finales.</li></br>
        <li><b>Consultas:</b> Informaci&oacute;n de los encargados de desarrollar el software.</li></br>
      </ul>
    </div>
	</div>
</body>
</html>