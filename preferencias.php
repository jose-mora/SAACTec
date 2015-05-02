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
            $result = [];


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

                if ($operation == "buscar_grupo") {  //si es regitrar sede 
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

            <div class="well well-lg">
                <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
<?php ?>
                    <h3>Agregar Preferencia Profesor</h3>
                    <label for="curso">Curso:</label>
                    <select class="form-control" name="curso" id="curso">
                    <?php
                    $cursosArray = $controlador->retornarCursosActivos();
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

                            <tr class="info">
                                <td>PETI02C</td>
                                <td class="hidden-xs"> 7 am - 9 am</td>
                                <td>San Jose</td>
                                <td><? echo "<a href='preferencias.php?prefA=PETI02C' class='btn btn-primary gestionBoton'> A </a> "; ?>
                                    <? echo "<a href='preferencias.php?prefB=PETI02C' class='btn btn-primary gestionBoton'> B </a> "; ?>
                                    <? echo "<a href='preferencias.php?prefC=PETI02C' class='btn btn-primary gestionBoton'> C </a> "; ?></td>

                            </tr>


                        </tbody>
                    </table>
                </div>
    <?php
}
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
                        <td><? echo $obj->ideGrupo; ?></td>
                        <td><? echo $obj->rank; ?></td>
                        <td><? echo "<a preferencias.php?delPref=". $obj->ideGrupo ."' class='btn btn-primary gestionBoton'> Remover </a> "; ?></td>

                        </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>

        </div>
    </div>

</body>
</html>