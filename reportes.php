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
            $mostrarReporte = false;
            $result = [];
            define('MAS_SOLICITADOS', 'Cursos mas solicitados');
            define('MENOS_SOLICITADOS', 'Cursos menos solicitados');
            

            include('dataLayer/controladorBaseDatos.php');
            include ('objetos/obj_reporte.php');
            $controlador = new controladorBaseDatos();

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $operation = $_POST["operation"];

                if ($operation == "reporte") {  //si es generar reporte
                    $cursoSeleccionado = test_input($_POST["curso"]);
                    
                    $_SESSION['cursoSeleccionado'] = $cursoSeleccionado;
                    
                    $_SESSION['cursoSeleccionado']= $cursoSeleccionado;

                    if ($cursoSeleccionado == "Cursos mas solicitados") {
                        $shop = $controlador->retornarCursosMasSolicitados();
                        $mostrarReporte = true;
                    } else {
                        $shop = $controlador->retornarCursosMenosSolicitados();
                        $mostrarReporte = true;
                    }
                }
                if ($operation == "guardar_reporte") {  //si es regitrar sede
                    $seleccionDelUsuario= $_SESSION['cursoSeleccionado'];
                    if ($seleccionDelUsuario == "Cursos mas solicitados"){
                        header('Location: controladores/controladorReporte.php');
                    }
                    else{
                        header('Location: controladores/controladorReporte2.php');
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
                <h2> Generaci&oacute;n de Reportes </h2>
                <blockquote>
                    <p>Secci&oacute;n que permite generar y analizar diversos reportes del sistema</p>
                </blockquote>
            </div>	
            </br>

            <div class="well well-lg">
                <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <?php ?>
                    <h3>Selecci&oacute;n de reporte</h3>
                    <label for="curso">Reporte:</label>
                    <select class="form-control" name="curso" id="curso">
                        <?php
                        echo "<option>" . MAS_SOLICITADOS . "</option>";
                        echo "<option>" . MENOS_SOLICITADOS . "</option>";
                        ?>
                    </select> 
                    <br/>
                    <input type="hidden" id="operation" name="operation" value="reporte">
                    <button type="submit" class="btn btn-primary">Generar Reporte</button>

                </form>
            </div>

            <?php
            if ($mostrarReporte) {
                ?>

                <div class="well well-lg">
                    <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <th>Curso</th>
                                    <th>Nivel</th>
                                    <th>Profesor</th>
                                    <th class="hidden-xs hidden-sm">Apellido</th>
                                    <th class="hidden-xs hidden-sm">Apellido</th>
                                    <th>Departamento</th>
                                    <th>Email</th>
                                    <th>Veces solicitado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php                                
                                $x = 1;
                                foreach ($shop as $obj) :
                                    if ($x == 1) {
                                        $x = 0;
                                        echo '<tr class="info">';
                                    } else {
                                        $x = 1;
                                        echo '<tr>';
                                    }
                                    ?>
                                <td><?php echo $obj->nombreCurso; ?></td>
                                <td><?php echo $obj->nivelCurso; ?></td>
                                <td><?php echo $obj->nombreProfesor; ?></td>
                                <td><?php echo $obj->apellido1Profesor; ?></td>
                                <td class="hidden-xs hidden-sm"><?php echo $obj->apellido2Profesor; ?></td>
                                <td><?php echo $obj->departamentoEscuelaProfesor; ?></td>
                                <td><?php echo $obj->emailProfesor; ?></td>
                                <td><?php echo $obj->vecesSolicitado; ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>

                        <input type="hidden" id="operation" name="operation" value="guardar_reporte">
                        <button type="submit" class="btn btn-primary">Guardar Reporte</button>

                    </form>
                </div>
                <?php
            }
            ?>

        </div>
    </body>
</html>