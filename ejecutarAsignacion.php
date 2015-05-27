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

            include("header.php");

            if (!$loggedHeader) {
                header('Location: ../Asignacion/index.php');
            }

            $validateFlag = FALSE;
            $successFlag = FALSE;
            $typeOperation = '';
            $numeroRespuesta = 0;
            $errorType = '';
            include('dataLayer/controladorBaseDatos.php');
            include('controladores/controladorAsignacionProfesores.php');

            $controlador = new controladorAsignacionProfesores();

           ?>

            <div>
                <h2> Asignación de Profesores </h2>
                <blockquote>
                    <p>Por favor espere a que el sistem termine de procesar los resultados</p>
                </blockquote>
            </div>	
            </br>  

            <div class="well well-lg">
                <div class="container-fluid" align="center">
                 <?php
                    $controlador->asignarProfesores("test");     
                 ?>   
                </div>
            </div>  

        </div>

        <script src="js/functions.js"></script> 
        <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>


