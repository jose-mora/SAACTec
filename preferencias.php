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
            $mostrarGrupos = false;
            $cursoABuscar = "";
            $result = [];
            $respuestaIngresar = 2;
            include('dataLayer/controladorBaseDatos.php');
            include('objetos/obj_preferencia.php');
            include('controladores/controladorMantenimientos.php');
            include('controladores/controladorPreferencias.php');
//            include('objetos/obj_curso.php');
            $controlador = new controladorMantenimientos();
            $controladorPrefs = new controladorPreferencias();

            //$result[] = new obj_preferencia('test@mail.com', 'A', 'TEST01C');
            //$result[] = new obj_preferencia('test@mail.com', 'B', 'TEST02C');
            //$result[] = new obj_preferencia('test@mail.com', 'C', 'TEST03C');

            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                if (!empty($_GET["prefA"])) {

                    $respuestaIngresar = $controladorPrefs->registrarPreferencia($_SESSION['prefProf'],$_GET["prefA"],'A');
                }
                if (!empty($_GET["prefB"])) {
                    $respuestaIngresar = $controladorPrefs->registrarPreferencia($_SESSION['prefProf'],$_GET["prefB"],'B');
                }
                if (!empty($_GET["prefC"])) {
                    $respuestaIngresar = $controladorPrefs->registrarPreferencia($_SESSION['prefProf'],$_GET["prefC"],'C');
                }
                if (!empty($_GET["prem"])) {
                    $_SESSION['prefProf']= $_GET["prem"];
                }
                if (!empty($_GET["delPref"])) {
                    $respuestaIngresar = $controladorPrefs->eliminarPreferencia($_GET["delPref"],$_SESSION['prefProf'],$_GET["delRank"]);
                }
                //
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $operation = $_POST["operation"];

                if ($operation == "buscar_grupo") {  //si es regitrar sede

                    $cursoABuscar = $_POST["curso"];
                    $mostrarGrupos = true;
                }
            }
            ?>
            <div>
                <h2> Preferencia de Profesores </h2>
                <blockquote>
                    <p>Secci&oacute;n que permite gestionar las preferencias de los profesores</p>
                </blockquote>
            </div>	
            </br>

    <?php

        $cantidadA = $controladorPrefs->cantidadA($_SESSION['prefProf']);
        $cantidadBC= $controladorPrefs->cantidadBC($_SESSION['prefProf']);

        if ($cantidadA > 0) { //si existen preferencias tipo A

            if ($cantidadBC < $cantidadA) { //si las BC no suman lo suficiente
                echo '<div class="alert alert-danger" role="alert">
                <p>La cantidad de preferencias B y C en conjunto debe ser igual o mayor a la cantidad de preferencias A</p>
                <p>Preferencias B y C: '.$cantidadBC.'</p>
                <p>Preferencias A: '.$cantidadA.'</p>
                </div>';

                $controladorPrefs->gestionarPreferencias($_SESSION['prefProf'],0);
            }else{
                $controladorPrefs->gestionarPreferencias($_SESSION['prefProf'],1);
            }
        }else{
            $controladorPrefs->gestionarPreferencias($_SESSION['prefProf'],1);
        }



        if ($respuestaIngresar == 1) {
            echo '<div class="alert alert-danger" role="alert">
                <p>Ya existe una preferencia registrada para ese grupo </p>
                </div>';
        }
        if ($respuestaIngresar == 0) {
            echo '<div class="alert alert-success" role="alert">
                <p>Acci&oacute;n realizada con &eacute;xito </p>
                </div>';
            $respuestaIngresar = 2;
        }
    ?>
            <div class="well well-lg">
                <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

                    <h3>Agregar Preferencia Profesor</h3>
                    <label for="curso">Curso:</label>
                    <select class="form-control" name="curso" id="curso">

                    <?php
                        $cursosArray = $controlador->retornarCursosActivos();
                        echo "Largo: ". count($cursosArray);

                        for ($i = 0; $i < (count($cursosArray)); $i++) {
                            echo "<option>" . $cursosArray[$i]->name . "</option>";
                        }
                    ?>

                    </select> 
                    <br/>
                    <input type="hidden" id="operation" name="operation" value="buscar_grupo">
                    <button type="submit" class="btn btn-primary">Buscar Grupos</button>
    
                </form>
            </div>

     <?php
       if ($mostrarGrupos) {
     ?>

                <div class="well well-lg">
                    <h3>Grupos del Curso</h3>
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th>Grupo</th>
                                <th class="hidden-xs">Franja Horaria</th>
                                <th>Sede</th>
                                <th class="hidden-xs">Nivel de Preferencia Grupo</th>
                            </tr>
                        </thead>
                        <tbody>
                <?php
                    $curso = $controlador->retornarCurso($cursoABuscar);
                    $gruposArray = $controlador->retornarGruposConIDCurso($curso->ide);
                    $x = 1;

                    foreach ($gruposArray as $obj) :
          
                        if ($x == 1) {
                            $x=0;
                            echo '<tr class="info">';         
                        } else {
                            $x=1;
                            echo '<tr>';
                        }

                ?>
                            
                                <td><?php echo $obj->ideGrupo; ?></td>
                                <td class="hidden-xs"> <?php echo $obj->franja; ?></td>
                                <td>San Jose</td>
                                <td><? echo "<a href='preferencias.php?prefA=".$obj->ideGrupo."' class='btn btn-primary gestionBoton'> A </a> "; ?>
                                    <? echo "<a href='preferencias.php?prefB=".$obj->ideGrupo."' class='btn btn-primary gestionBoton'> B </a> "; ?>
                                    <? echo "<a href='preferencias.php?prefC=".$obj->ideGrupo."' class='btn btn-primary gestionBoton'> C </a> "; ?></td>

                            </tr>
                    <?php endforeach; ?>


                        </tbody>
                    </table>
                </div>
    <?php
        }//else de mostrar grupos
    ?>


            <div class="well well-lg">
                <h3>Preferencias Agregadas</h3>
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th>Grupo</th>
                            <th>Rango</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>


    <?php

        if (isset($_SESSION['prefProf'])) {

            $result = $controladorPrefs->retornarPreferenciasProfesor($_SESSION['prefProf']);

        
            $x = 1;
            foreach ($result as $obj) :
                if ($x == 1) {
                    $x = 0;
                    echo '<tr class="info">';
                } else {
                    $x = 1;
                    echo '<tr>';
                }
    ?>
                        <td><?php echo $obj->ideGrupo; ?></td>
                        <td><?php echo $obj->rank; ?></td>
                        <td><?php echo "<a href='preferencias.php?delPref=". $obj->ideGrupo ."&delRank=".$obj->rank."' class='btn btn-primary gestionBoton'> Remover </a> "; ?></td>

                        </tr>
    <?php   endforeach; 

        }
    ?>

                    </tbody>
                </table>
            </div>

        </div>
    </div>

</body>
</html>