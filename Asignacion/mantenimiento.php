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
            $successFlag = FALSE;
            $typeOperation = '';
            $numeroRespuesta = 0;
            $errorType = '';

            include('controladores/controladorMantenimientos.php');
            $controlador = new controladorMantenimientos();

            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                if (!empty($_GET["etype"])) {

                    $errorType = $_GET["etype"];
                }
                if (!empty($_GET["grupoDes"])) {
                    $grupoGest = $_GET["grupoDes"];
                    $numeroRespuesta = $controlador->gestionarGrupo($grupoGest, 0);
                    procesarRespuesta($numeroRespuesta, 'modGrupo');
                }
                if (!empty($_GET["grupoAct"])) {
                    $grupoGest = $_GET["grupoAct"];
                    $numeroRespuesta = $controlador->gestionarGrupo($grupoGest, 1);
                    procesarRespuesta($numeroRespuesta, 'modGrupo');
                }

                if (!empty($_GET["sedeDes"])) {
                    $sedeGest = $_GET["sedeDes"];
                    $numeroRespuesta = $controlador->gestionarSede($sedeGest, 0);
                    procesarRespuesta($numeroRespuesta, 'modSede');
                }
                if (!empty($_GET["sedeAct"])) {
                    $sedeGest = $_GET["sedeAct"];
                    $numeroRespuesta = $controlador->gestionarSede($sedeGest, 1);
                    procesarRespuesta($numeroRespuesta, 'modSede');
                }
                if (!empty($_GET["cursoDes"])) {

                    $cursoGest = $_GET["cursoDes"];
                    $numeroRespuesta = $controlador->gestionarCurso($cursoGest, 0);
                    procesarRespuesta($numeroRespuesta, 'modCurso');
                }

                if (!empty($_GET["cursoAct"])) {

                    $cursoGest = $_GET["cursoAct"];
                    $numeroRespuesta = $controlador->gestionarCurso($cursoGest, 1);
                    procesarRespuesta($numeroRespuesta, 'modCurso');
                }

                if (!empty($_GET["franjaDes"])) {

                    $franjaGest = $_GET["franjaDes"];
                    $numeroRespuesta = $controlador->gestionarFranja($franjaGest, 0);
                    procesarRespuesta($numeroRespuesta, 'modFranja');
                }

                if (!empty($_GET["franjaAct"])) {

                    $franjaGest = $_GET["franjaAct"];
                    $numeroRespuesta = $controlador->gestionarFranja($franjaGest, 1);
                    procesarRespuesta($numeroRespuesta, 'modFranja');
                }
            } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $operation = $_POST["operation"];

                if ($operation == "sede_reg") {  //si es regitrar sede
                    $nombreSede = $_POST["name"];
                    $numeroRespuesta = $controlador->registrarSede($nombreSede);
                    procesarRespuesta($numeroRespuesta, 'regSede');
                }
                if ($operation == "curso_reg") {  //si es regitrar curso
                    $nombreCurso = $_POST["name"];
                    $numeroRespuesta = $controlador->registrarCurso($nombreCurso);
                    procesarRespuesta($numeroRespuesta, 'regCurso');
                }
                if ($operation == "franja_reg") {  //si es regitrar franja
                    $inicio = $_POST["franjaInicio"];
                    $fin = $_POST["franjaFin"];
                    $numeroRespuesta = $controlador->registrarFranja($inicio, $fin);
                    procesarRespuesta($numeroRespuesta, 'regFranja');
                }
                if ($operation == "grupo_reg") { //si es registrar grupo
                    $ideGrupo = $_POST["ideGrupo"];
                    $curso = $_POST["curso"];
                    $sede = $_POST["sede"];
                    $franja = $_POST["franja"];

                    $numeroRespuesta = $controlador->registrarGrupo($ideGrupo, $curso, $sede, $franja);
                    procesarRespuesta($numeroRespuesta, 'regGrupo');
                }
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
                <h2> Mantenimientos </h2>
                <blockquote>
                    <p>A continuaci&oacute;n se muestra la lista opciones para el mantenimiento del sistema, toda la gesti&oacute;n de sedes, franjas, 
                        cursos y grupos puede realizarse desde esta pagina</p>
                </blockquote>
            </div>	
            </br>  

            <div class="well well-lg">
                <div class="container-fluid" align="center">

                    <!--Sedes-->
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Gestionar sedes
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="mantenimiento.php?etype=regSede">Registrar sede</a></li>
                            <li class="divider"></li>
                            <li><a href="mantenimiento.php?etype=modSede">Gestionar sede</a></li>
                        </ul>
                    </div>
                    <!--Cursos-->
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Gestionar Curso 
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="mantenimiento.php?etype=regCurso">Registrar Curso</a></li>
                            <li class="divider"></li>
                            <li><a href="mantenimiento.php?etype=modCurso">Gestionar Cursos</a></li>
                        </ul>
                    </div>
                    <!-- Grupos-->
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Gestionar Grupo 
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="mantenimiento.php?etype=regGrupo">Registrar Grupo</a></li>
                            <li class="divider"></li>
                            <li><a href="mantenimiento.php?etype=modGrupo">Gestionar Grupo</a></li>
                        </ul>
                    </div>
                    <!-- Franjas-->
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Gestionar Franjas 
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="mantenimiento.php?etype=regFranja">Registrar Franjas</a></li>
                            <li class="divider"></li>
                            <li><a href="mantenimiento.php?etype=modFranja">Gestionar Franjas</a></li>
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
            <!--
            Seccion para registrar sedes en el sistema
            -->
            <?php
            if ($errorType == 'regSede')
                include("mantenimiento/regSede.php");
            ?>
            <!--
            Seccion para modificar sedes en el sistema
            -->
            <?php
            if ($errorType == 'modSede')
                include("mantenimiento/modsede.php");
            ?>

            <!--
    Seccion para registrar curso en el sistema
            -->
            <?php
            if ($errorType == 'regCurso')
                include("mantenimiento/regCurso.php");
            ?>
            <!--
            Seccion para modificar cursos en el sistema
            -->
            <?php
            if ($errorType == 'modCurso')
                include("mantenimiento/modCurso.php");
            ?>
            <!--
    Seccion para registrar grupos en el sistema
            -->
            <?php
            if ($errorType == 'regGrupo')
                include("mantenimiento/regGrupo.php");
            ?>
            <!--
    Seccion para registrar franjas en el sistema
            -->
            <?php
            if ($errorType == 'regFranja')
                include("mantenimiento/regFranja.php");
            ?>

            <!--
            Seccion para modificar grupos en el sistema
            -->
            <?php
            if ($errorType == 'modGrupo')
                include("mantenimiento/modGrupo.php");
            ?>

            <!--
           Seccion para modificar franjas en el sistema
            -->
            <?php
            if ($errorType == 'modFranja')
                include("mantenimiento/modFranja.php");
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


