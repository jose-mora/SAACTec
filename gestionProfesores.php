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
            $mostrarLista = false;
            $mostrarActualizar = false;
            $result = [];

            include('objetos/obj_profesor.php');
            include('controladores/controladorProfesores.php');
            $controlador = new controladorProfesores();

            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                if (!empty($_GET["etype"])) {

                    $errorType = $_GET["etype"];
                }
                if (!empty($_GET["objDes"])) {
                    $emailDesactivar = $_GET["objDes"];
                    $numeroRespuesta = $controlador->gestionarProfesor($emailDesactivar, 0);
                    //procesarRespuesta($numeroRespuesta,'modGrupo');
                }
                if (!empty($_GET["objActi"])) {
                    $emailActivar = $_GET["objActi"];
                    $numeroRespuesta = $controlador->gestionarProfesor($emailActivar, 1);
                    //procesarRespuesta($numeroRespuesta,'modGrupo');
                }
                if (!empty($_GET["objUpdate"])) {
                    $emailProfesor = $_GET["objUpdate"];
                    $objProfesor = $controlador->retornarProfesor($emailProfesor);
                    $mostrarActualizar = true;
                    //procesarRespuesta($numeroRespuesta,'modGrupo');
                }
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $operation = $_POST["operation"];


                if ($operation == "prof_buscar") {  //si es regitrar sede
                    $criterio = $_POST["criterio"];
                    $valor = $_POST["valor"];

                    if ($valor != "") {

                        $shop = $controlador->retonarProfesor($criterio, $valor);

                        if (count($shop) >= 1) {
                            $mostrarLista = true;
                        }
                    }
                }
                if ($operation == "prof_actualizar") {  //si es regitrar curso
                    $username = test_input($_POST["name"]);
                    $lastname = test_input($_POST["lastname"]);
                    $lastname2 = test_input($_POST['lastname2']);
                    $email = test_input($_POST["email"]);
                    $tel = test_input($_POST["tel"]);
                    $emailOri = test_input($_POST["emailOriginal"]);

                    if (strlen($username) <= 0) {
                        $validateFlag = TRUE;
                    }
                    if (strlen($lastname) <= 0) {
                        $validateFlag = TRUE;
                    }
                    if (strlen($lastname2) <= 0) {
                        $validateFlag = TRUE;
                    }
                    if (strlen($email) <= 0) {
                        $validateFlag = TRUE;
                    }
                    if (strlen($tel) <= 0) {
                        $validateFlag = TRUE;
                    }

                    if (!$validateFlag) { //if the validation passes
                        $prof = new obj_profesor(1, $username, $lastname, $lastname2, $email, $tel);
                        $resultado = $controlador->actualizarProfesor($prof, $emailOri);
                    } else {

                        //mostrar error, campos vacios
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
                <h2> B&uacute;squeda de profesores </h2>
                <blockquote>
                    <p>A continuaci&oacute;n se muestran las opciones de b&uacute;squeda para localizar un profesor y realizar la gesti&oacute;n necesaria</p>
                </blockquote>
            </div>	
            </br>

            <div class="well well-lg">
                <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <label for="critero"> Criterio de b&uacute;squeda</label>
                    <select class="form-control" name="criterio" id="criterio">
                        <option>Nombre</option>
                        <option>Primer apellido</option>
                        <option>Segundo apellido</option>
                        <option>Correo electr&oacute;</option>
                    </select>


                    <label for="name">Valor:</label>
                    <input type="text" class="form-control" name="valor" id="valor">
                    <br/><br/>

                    <input type="hidden" id="operation" name="operation" value="prof_buscar">
                    <button type="submit" class="btn btn-primary">Buscar</button>

                </form>
            </div>
            <?php
            if ($mostrarLista) {
                ?>

                <div class="well well-lg">
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th class="hidden-xs">Correo electr&oacute;</th>
                                <th>Acci&oacute;n</th>
                                <th class="hidden-xs">Actualizar</th>
                                <th>Notas</th>
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
                            <td><?php echo $obj->name . ' ' . $obj->apellido1 ?></td>
                            <td class="hidden-xs"><?php echo $obj->email; ?></td>

                            <?php
                            if ($obj->activo == 1) {
                                ?>
                                <td><?php echo "<a href='gestionProfesores.php?objDes=" . $obj->email . "' class='btn btn-primary gestionBoton'> Desactivar </a> "; ?></td>
                                <?php
                            } else {
                                ?>x
                                <td><?php echo "<a href='gestionProfesores.php?objActi=" . $obj->email . "' class='btn btn-primary gestionBoton'> Activar </a> "; ?></td>
                                <?php
                            }
                            ?>

                            <td class="hidden-xs"><?php echo "<a href='gestionProfesores.php?objUpdate=" . $obj->email . "' class='btn btn-primary gestionBoton'> Actualizar </a> "; ?></td>
                            <td><?php echo "<a href='notaProfesor.php?prgest=" . $obj->email . "' class='btn btn-primary gestionBoton'> Gestionar </a> "; ?></td>

                            </tr>
                        <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
                <?php
            }
            ?>

            <?php
            if ($mostrarActualizar) {
                ?>
                <div class="well well-lg">
                    <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <?php
                        /* if ($validateFlag) {
                          echo '<div class="alert alert-danger" role="alert">
                          <p>Se deben llenar todos los campos </p>
                          </div>';
                          }

                          if ($successFlag) {
                          echo '<div class="alert alert-success" role="alert">
                          <p>Profesor registrado con &eacute;xito </p>
                          </div>';
                          } */
                        ?>
                        <h3>Actualizar profesor</h3>
                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input type="text" class="form-control" name="name" id="name" value="<?php echo htmlentities($objProfesor->name) ?>">
                        </div>
                        <div class="form-group">
                            <label for="lastname">Primer apellido:</label>
                            <input type="text" class="form-control" name="lastname" id="lastname" value="<?php echo htmlentities($objProfesor->apellido1) ?>">
                        </div>
                        <div class="form-group">
                            <label for="lastname">Segundo apellido:</label>
                            <input type="text" class="form-control" name="lastname2" id="lastname2" value="<?php echo htmlentities($objProfesor->apellido2) ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Correo electr&oacute;:</label>
                            <input type="email" class="form-control" name="email" id="email" value="<?php echo htmlentities($objProfesor->email) ?>">
                        </div>
                        <div class="form-group">
                            <label for="tel">Tel&eacute;fono:</label>
                            <input type="telephone" class="form-control" id="tel" name="tel" value="<?php echo htmlentities($objProfesor->tel) ?>">
                        </div>

                        <input type="hidden" id="emailOriginal" name="emailOriginal" value="<?php echo htmlentities($objProfesor->email) ?>">
                        <input type="hidden" id="operation" name="operation" value="prof_actualizar">
                        <button type="submit" class="btn btn-primary">Actualizar</button>

                    </form>
                    <?php
                }
                ?>

            </div>
        </div>

    </body>
</html>