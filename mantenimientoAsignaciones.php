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

            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                
            } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                
            }

            function procesarRespuesta($numeroRespuesta, $encargado) {

                global $errorType, $successFlag;

                if ($numeroRespuesta == 0) { //si el numero de respuesta es 0 fue EXITO
                    $successFlag = TRUE;
                } else { // sino ya la persona estaba registrada o paso un problema, tenemos que mostrar el div
                    $errorType = $encargado;
                }
            }
            ?>

            <div>
                <h2> Proceso de Asignacion </h2>
                <blockquote>
                    <p>A continuaci&oacute;n se muestra la lista opciones para la asignación de cargas</p>
                </blockquote>
            </div>	
            </br>  

            <div class="well well-lg">
                <div class="container-fluid" align="center">

                    <!--Sedes-->
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Gestionar Proceso Asignacion
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="gestionProcesosAsignacion.php?etype=regAsignacion">Registrar Asignacion</a></li>
                            <li class="divider"></li>
                            <li><a href="gestionProcesosAsignacion.php?etype=actAsignacion">Activar Asignacion</a></li>
                        </ul>
                    </div>
                    
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Generar Asignaciones 
                            <span class="caret"></span>
                        </button>
                    </div>

                </div>
            </div>  

            <?php
            if ($successFlag) {
                echo '<div class="alert alert-success" role="alert">
                   	<p>Operacion realizada con &eacute;xito</p>
              		</div>';
            }
            ?>

        </div>

        <?php
        if ($errorType != '') {
            echo "<script type='text/javascript'> document.getElementById('" . $errorType . "').style.display='block'; </script>";
        }
        ?>

        <script src="js/functions.js"></script> 
        <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
