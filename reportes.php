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
            define('MAS_SOLICITADOS', 'Cusos mas solicitados');
            define('MENOS_SOLICITADOS', 'Cursos menos solicitados');


            include('objetos/obj_preferencia.php');
            include('controladores/controladorMantenimientos.php');
            $controlador = new controladorMantenimientos();

            $result[] = new obj_preferencia('test@mail.com', 'A', 'TEST01C');
            $result[] = new obj_preferencia('test@mail.com', 'B', 'TEST02C');
            $result[] = new obj_preferencia('test@mail.com', 'C', 'TEST03C');

            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                if (!empty($_GET["prefA"])) {
                    $result[] = new obj_preferencia('test@mail.com', 'A', $_GET["prefA"]);
                }
                if (!empty($_GET["prefB"])) {
                    $result[] = new obj_preferencia('test@mail.com', 'B', $_GET["prefB"]);
                }
                if (!empty($_GET["prefC"])) {
                    $result[] = new obj_preferencia('test@mail.com', 'C', $_GET["prefC"]);
                }
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $operation = $_POST["operation"];


                if ($operation == "reporte") {  //si es regitrar sede
                    $mostrarReporte = true;
                }
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
                                    <th>Grupo</th>
                                    <th>Curso</th>
                                    <th>Solicitudes</th>

                                </tr>
                            </thead>
                            <tbody>

                                <tr class="info">
                                    <td>PETI02C</td>
                                    <td>PETI</td>
                                    <td>4</td>
                                </tr>
                                <tr>
                                    <td>SIA01</td>
                                    <td>SIA</td>
                                    <td>4</td>
                                </tr>

                                <tr class="info">
                                    <td>ADMI01</td>
                                    <td>Administracion de Proyectos</td>
                                    <td>3</td>
                                </tr>



                            </tbody>
                        </table>

                        <input type="hidden" id="operation" name="operation" value="reporte">
                        <button type="submit" class="btn btn-primary">Guardar Reporte</button>

                    </form>
                </div>
    <?php
}
?>

        </div>
    </body>
</html>