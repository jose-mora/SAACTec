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
            $emptyAmmount = 0;
            $successFlag = FALSE;
            $typeOperation = '';
            $numeroRespuesta = 0;
            $errorType = '';

            include('dataLayer/controladorBaseDatos.php');
            include('controladores/controladorProcesosAsignacion.php');
            include('objetos/obj_procesoAsignacion.php');

            $controlador = new controladorProcesosAsignacion();


            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                if (!empty($_GET["etype"])) {

                    $errorType = $_GET["etype"];
                }
                
                if (!empty($_GET["procesoDes"])) {
                    $procesoGes = $_GET["procesoDes"];
                    $numeroRespuesta = $controlador->activarProcesosAsignacion($procesoGes, 0);
                }

                 if (!empty($_GET["procesoDel"])) {
                    $procesoGes = $_GET["procesoDel"];
                    $numeroRespuesta = $controlador->ejecutarProcesosAsignacion($procesoGes, 0);
                    include('controladores/controladorResultadoProcAsignacion.php');
                    include('objetos/obj_resultadoProcAsignacion.php');
                    $controladorResul = new controladorResultadoProcAsignacion();
                    $numeroRespuesta = $controladorResul->eliminarResultadoProcAsignacion($procesoGes, 0);
                }
                
                if (!empty($_GET["procesoAct"])) {
                    $procesoGes = $_GET["procesoAct"];
                    $numeroRespuesta = $controlador->activarProcesosAsignacion($procesoGes, 1);
                }

                
            } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $operation = $_POST["operation"];

                if ($operation == "reg_Asignacion") { 
                    
                    $modalidad = test_input($_POST["modalidad"]);
                    $periodoLectivo = test_input($_POST["periodoLectivo"]);

                    if ($modalidad != "Seleccione") {
                        $tiempo = test_input($_POST["tiempo"]);
                        $periodo = $modalidad . ' ' . $tiempo . ' ' . $periodoLectivo;
                    }

                    if ($modalidad == "Seleccione") {
                        $validateFlag = TRUE;
                        $emptyAmmount++;
                    }

                    if (!$validateFlag) {

                        $numeroRespuesta = $controlador->registrarProcesoAsignacion($periodo);

                        if ($numeroRespuesta==1){
                            echo '<div class="alert alert-danger" role="alert">
                                 <p>Este proceso de asignacion ya existe</p>
                                 </div>';
                        } else {
                                echo '<div class="alert alert-success" role="alert">
                                 <p>El proceso de asignacion se registro con exito</p>
                                 </div>';
                        }
                        
                    }
                    else {
                        echo '<div class="alert alert-danger" role="alert">
                             <p>Todos los campos son requeridos</p>
                             </div>';
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
                <h2> Mantenimientos </h2>
                <blockquote>
                    <p>A continuaci&oacute;n se muestra la lista opciones para el mantenimiento del sistema, toda la gesti&oacute;n de sedes, franjas, 
                        cursos y grupos puede realizarse desde esta pagina</p>
                </blockquote>
            </div>  
            </br>  

            <div class="well well-lg">
                <div class="container-fluid" align="center">

                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Gestionar Proceso Asignacion
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="gestionProcesosAsignacion.php?etype=regAsignacion">Registrar Asignacion</a></li>
                            <li class="divider"></li>
                            <li><a href="gestionProcesosAsignacion.php?etype=modAsignacion">Gestionar Asignacion</a></li>
                        </ul>
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

            <?php
            if ($errorType == 'regAsignacion')
                include("mantenimiento/regAsignacion.php");
            ?>

            <?php
            if ($errorType == 'modAsignacion')
                include("mantenimiento/modAsignacion.php");
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


