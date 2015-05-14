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
        <script src="js/jquery.min.js"></script>
        <script>
            $(document).ready(function() {

//let's create arrays
                var semestre = [
                    {display: "1", value: "1"},
                    {display: "2", value: "2"}];

                var cuatrimestre = [
                    {display: "1", value: "1"},
                    {display: "2", value: "2"},
                    {display: "3", value: "3"}];

                var bimestre = [
                    {display: "1", value: "1"},
                    {display: "2", value: "2"},
                    {display: "3", value: "3"},
                    {display: "4", value: "4"},
                    {display: "5", value: "5"},
                    {display: "6", value: "6"}];
                $("#modalidad").change(function() {
                    var parent = $(this).val();
                    switch (parent) {
                        case 'semestre':
                            list(semestre);
                            break;
                        case 'cuatrimestre':
                            list(cuatrimestre);
                            break;
                        case 'bimestre':
                            list(bimestre);
                            break;
                        default: //default child option is blank
                            $("#tiempo").html('');
                            break;
                    }
                });


                function list(array_list)
                {
                    $("#tiempo").html(""); //reset child options
                    $(array_list).each(function(i) { //populate child options 
                        $("#tiempo").append("<option value=\"" + array_list[i].value + "\">" + array_list[i].display + "</option>");
                    });
                }

            });
        </script>

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

            $validateFlag = false;
            $emptyAmmount = 0;
            $successFlag = false;
            $mostrarLista = false;
            $result = [];
            include('dataLayer/controladorBaseDatos.php');
            include('objetos/obj_profesor.php');
            include('objetos/obj_nota.php');
            include('controladores/controladorProfesores.php');
            include('controladores/controladorHistoricoNotas.php');
            $controlador = new controladorProfesores();
            $controlador2 = new controladorHistoricoNotas();

            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                if (!empty($_GET["activarNota"])) {
                    $parametros = $_GET["activarNota"];
                    $param = explode(" ", $parametros);
                    $idProfesor = $param[1];
                    $tiempo = $param[2];
                    $modalidad = $param[3];
                    $periodoLectivo = $param[4];

                    $resultado = $controlador2->anularNota($idProfesor, $tiempo, $modalidad, $periodoLectivo, 0);
                    if ($resultado == 0) {
                        echo '<div class="alert alert-success" role="alert">
                             <p>Se ha realizado la acción con éxito</p>
                             </div>';
                    } else {
                        echo '<div class="alert alert-danger" role="alert">
                             <p>No se ha podido realizar la acción con éxito</p>
                             </div>';
                    }
                }
                if (!empty($_GET["desactivarNota"])) {
                    $parametros = $_GET["desactivarNota"];
                    $param = explode(" ", $parametros);
                    $idProfesor = $param[1];
                    $tiempo = $param[2];
                    $modalidad = $param[3];
                    $periodoLectivo = $param[4];

                    $resultado = $controlador2->anularNota($idProfesor, $tiempo, $modalidad, $periodoLectivo, 1);
                    if ($resultado == 0) {
                        echo '<div class="alert alert-success" role="alert">
                             <p>Se ha realizado la acción con éxito</p>
                             </div>';
                    } else {
                        echo '<div class="alert alert-danger" role="alert">
                             <p>No se ha podido realizar la acción con éxito</p>
                             </div>';
                    }
                }
                if (!empty($_GET["prgest"])) {
                    //TODO Hacer el llamado del método que devuelve las notas del profesor
                    $emailProfesor = $_GET["prgest"];
                    $objProfesor = $controlador->retornarProfesor($emailProfesor);
                    $idProfesor = $objProfesor->ide;
                    $_SESSION['profesor'] = $idProfesor;

                    $shop = $controlador2->retornarNotas($idProfesor);

                    if (count($shop) >= 1) {
                        $mostrarLista = true;
                    }
                }
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $operation = $_POST["operation"];

                if ($operation == "agregar_nota") {  //si es agregar nota
                    $idProfesor = $_SESSION['profesor'];
                    $modalidad = test_input($_POST["modalidad"]);
                    $periodoLectivo = test_input($_POST["periodoLectivo"]);
                    $nota = test_input($_POST["nota"]);

                    if ($modalidad != "Seleccione") {
                        $tiempo = test_input($_POST["tiempo"]);
                        $periodo = $tiempo . ' ' . $modalidad . ' ' . $periodoLectivo;
                    }

                    if ($modalidad == "Seleccione") {
                        $validateFlag = TRUE;
                        $emptyAmmount++;
                    }
                    if ($nota <= 0) {
                        $validateFlag = TRUE;
                        $emptyAmmount++;
                    }

                    if (!$validateFlag) {
                        $historicoNota = new obj_nota($idProfesor, $periodo, $nota, 0);
                        $resultado = $controlador2->registrarNota($historicoNota);
                        if ($resultado == 1) {
                            echo '<div class="alert alert-danger" role="alert">
                             <p>Esta nota ya se encuentra registrada para este profesor</p>
                             </div>';
                        } else {
                            echo '<div class="alert alert-success" role="alert">
                             <p>Se ha registrado la nota con éxito</p>
                             </div>';
                        }

                        $shop = $controlador2->retornarNotas($idProfesor);

                        if (count($shop) >= 1) {
                            $mostrarLista = true;
                        }
                    } else {
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
                <h2> Notas del profesor </h2>
                <blockquote>
                    <p>Se muestra la lista de las últimas 10 notas del profesor, con la posibilidad de agregar nuevas o anularlas </p>
                </blockquote>
            </div>	
            </br>

            <div class="well well-lg">
                <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

                    <label for="critero"> Modalidad</label>
                    <select class="form-control" name="modalidad" id="modalidad">                        
                        <option>Seleccione</option>
                        <option value="semestre">Semestre</option>
                        <option value="cuatrimestre">Cuatrimestre</option>
                        <option value="bimestre">Bimestre</option>
                    </select>

                    <label for="critero"> N&uacute;mero</label>
                    <select class="form-control" name="tiempo" id="tiempo">
                    </select>

                    <label for="critero"> Per&iacute;odo lectivo</label>
                    <select class="form-control" name="periodoLectivo" id="periodoLectivo">
                        <option>2013</option>
                        <option>2014</option>
                        <option selected>2015</option>
                        <option>2016</option>
                        <option>2017</option>
                        <option>2018</option>
                        <option>2019</option>
                        <option>2020</option>
                    </select>

                    <label for="name">Nota:</label>
                    <input type="text" class="form-control" name="nota" id="nota">
                    <br/><br/>

                    <input type="hidden" id="operation" name="operation" value="agregar_nota">
                    <button type="submit" class="btn btn-primary">Agregar</button>

                </form>
            </div>
            <br/>
            <?php
            if ($mostrarLista) {
                ?>
                <div class="well well-lg">
                    <h3>Notas anteriores</h3>
                    <label for="curso">Notas:</label>

                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th>Nota</th>
                                <th>Per&iacute;odo</th>
                                <th>Anular</th>
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
                            <td><?php echo $obj->nota ?></td>
                            <td><?php echo $obj->periodo ?></td>

                            <?php
                            if ($obj->anular == 1) {
                                ?>
                                <td><?php echo "<a href='notaProfesor.php?activarNota= " . $_SESSION['profesor'] . " " . $obj->periodo . "' class='btn btn-primary gestionBoton'> Activar </a> "; ?></td>
                                <?php
                            } else {
                                ?>
                                <td><?php echo "<a href='notaProfesor.php?desactivarNota= " . $_SESSION['profesor'] . " " . $obj->periodo . "' class='btn btn-primary gestionBoton'> Desactivar </a> "; ?></td>
                                <?php
                            }
                            ?>
                            </tr>                            
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>