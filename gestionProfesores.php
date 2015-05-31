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

        <script type="text/javascript">
          function habilitarTextBox(checkBool, textID) {
            for (var i = 0; i < textID.length; i++) {
                textFldObj = document.getElementById(textID[i]);
                textFldObj.disabled = !checkBool;
                if (!checkBool) { textFldObj.value = ''; }
            };
          }
        </script>

        <div class="container">

            <?php
            session_start(); //importante arrancar el session luego de incluir los objetos, sino tira un error que no conoce el objeto a crear

            include("header.php");

            if (!$loggedHeader) {
                header('Location: ../Asignacion/index.php');
            }

            $validateFlag = false;
            $validateFlagPswd = FALSE;
            $mostrarLista = false;
            $mostrarActualizar = false;
            $emptyAmmount = 0;
            $successFlag = FALSE;
            $result = [];
            include('dataLayer/controladorBaseDatos.php');
            include('objetos/obj_profesor.php');
            include('controladores/controladorProfesores.php');
            $controlador = new controladorProfesores();

            include('objetos/obj_usuario.php');
            include('controladores/controladorUsuarios.php');
            $controladorUsuario = new controladorUsuarios();

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
                    $validateFlag = false;
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
                    } else if ($criterio == "Todos") {
                        $shop = $controlador->retornarTodosLosProfesores();
                        
                        if (count($shop) >= 1) {
                            $mostrarLista = true;
                        }
                    } else {
                        echo '<div class="alert alert-danger" role="alert">
                             <p>No se proporcionó ningún valor a buscar</p>
                             </div>';
                    }
                }
                if ($operation == "prof_actualizar") {  //si es regitrar curso
                    $tipoProfesor = test_input($_POST["tipoProfesor"]);
                    $departamentoEscuela = test_input($_POST["departamentoEscuela"]);
                    $gradoAcademicoProfesor = test_input($_POST["gradoAcademicoProfesor"]);
                    $cedula = test_input($_POST["cedula"]);
                    $username = test_input($_POST["name"]);
                    $lastname = test_input($_POST["lastname"]);
                    $lastname2 = test_input($_POST['lastname2']);
                    $email = test_input($_POST["email"]);
                    $tel = test_input($_POST["tel"]);
                    $cel = test_input($_POST["cel"]);
                    $jornadaLaboral = test_input($_POST["jornadaLaboral"]);
                    $direccion = test_input($_POST["direccion"]);
                    $emailOri = test_input($_POST["emailOriginal"]);

                    if ($tipoProfesor == "Seleccione") {
                        $validateFlag = TRUE;
                        $emptyAmmount++;
                    }
                    if ($departamentoEscuela == "Seleccione") {
                        $validateFlag = TRUE;
                        $emptyAmmount++;
                    }
                    if ($gradoAcademicoProfesor == "Seleccione") {
                        $validateFlag = TRUE;
                        $emptyAmmount++;
                    }
                    if (strlen($cedula) <= 0) {
                        $validateFlag = TRUE;
                        $emptyAmmount++;
                    }
                    if (strlen($username) <= 0) {
                        $validateFlag = TRUE;
                        $emptyAmmount++;
                    }
                    if (strlen($lastname) <= 0) {
                        $validateFlag = TRUE;
                        $emptyAmmount++;
                    }
                    if (strlen($lastname2) <= 0) {
                        $validateFlag = TRUE;
                        $emptyAmmount++;
                    }
                    if (strlen($email) <= 0) {
                        $validateFlag = TRUE;
                        $emptyAmmount++;
                    }
                    if (strlen($tel) <= 0) {
                        $validateFlag = TRUE;
                        $emptyAmmount++;
                    }
                    if (strlen($cel) <= 0) {
                        $validateFlag = TRUE;
                        $emptyAmmount++;
                    }
                    if ($jornadaLaboral == "Seleccione") {
                        $validateFlag = TRUE;
                        $emptyAmmount++;
                    }
                    if (strlen($direccion) <= 0) {
                        $validateFlag = TRUE;
                        $emptyAmmount++;
                    }

                    if (isset($_POST['chkPassword'])) {
                        $passwd = $_POST["password"];
                        $rePasswd = $_POST["rePassword"];

                        if ((strlen($passwd) <= 0) || (strlen($rePasswd) <= 0)){
                            $validateFlag = TRUE;
                            $emptyAmmount++;
                        } else {
                            if (strcmp($passwd, $rePasswd)!=0){
                                $validateFlag = TRUE;
                                $validateFlagPswd = TRUE;
                            }
                        }
                    }

                    if (!$validateFlag) { //if the validation passes                        
                        $prof = new obj_profesor($tipoProfesor, $departamentoEscuela, $gradoAcademicoProfesor, $cedula, $username, $lastname, $lastname2, $email, $tel, $cel, $jornadaLaboral, $direccion);
                        $resultado = $controlador->actualizarProfesor($prof, $emailOri);
                        
                        if ($resultado==12){
                            echo '<div class="alert alert-danger" role="alert">
                             <p>Esta dirección de correo ya existe, se canceló la actualización</p>
                             </div>';

                        } else {

                            //Si es cambio de correo (username)
                            if (strcmp($email, $emailOri)!=0){
                                $resultado = $controladorUsuario->actualizarUsuario($email,$emailOri);
                            }
                            //Si cambia la contraseña
                            if (isset($_POST['chkPassword'])){
                                $resultado = $controladorUsuario->actualizarContrasena($passwd,$emailOri);
                            }

                            echo '<div class="alert alert-success" role="alert">
                                 <p>Se actualizó el profesor correctamente</p>
                                 </div>';
                        }
                    } else {
//                        $prof = new obj_profesor($tipoProfesor, $departamentoEscuela, $gradoAcademicoProfesor, $cedula, $username, $lastname, $lastname2, $email, $tel, $cel, $jornadaLaboral, $direccion);
//                        $resultado = $controlador->actualizarProfesor($prof, $emailOri);
//                        echo "se actualizo el profesor correctamente";
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
                        <option>Todos</option>
                        <option>Nombre</option>
                        <option>Primer apellido</option>
                        <option>Segundo apellido</option>
                        <option>Correo electr&oacute;nico</option>
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
                                <th class="hidden-xs">Correo electr&oacute;nico</th>
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
                                ?>
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
                        if ($validateFlag) {
                            echo '<div class="alert alert-danger" role="alert">
                          <p>Se deben llenar todos los campos </p>
                          </div>';
                        }

                        if ($successFlag) {
                            echo '<div class="alert alert-success" role="alert">
                          <p>Profesor registrado con &eacute;xito </p>
                          </div>';
                        }
                        ?>
                        <h3>Actualizar profesor</h3>
                        <div class="form-group">
                            <label for="tipoProfesor">Tipo de profesor: <?php echo htmlentities($objProfesor->tipoProfesor) ?></label>
                            <select class="form-control" name="tipoProfesor" id="tipoProfesor">
                                <option>Seleccione</option>
                                <?php
                                $opcionSeleccionada = $objProfesor->tipoProfesor;
                                $seleccionado = "";
                                if ($opcionSeleccionada == "Con plaza") {
                                    $seleccionado = "selected";
                                    ?>
                                    <option <?php echo $seleccionado ?>>Con plaza</option>
                                    <option>Interino</option>
                                    <?php
                                } elseif ($opcionSeleccionada == "Interino") {
                                    $seleccionado = "selected";
                                    ?>
                                    <option>Con plaza</option>
                                    <option <?php echo $seleccionado ?>>Interino</option>                                    
                                    <?php
                                }
                                ?>
                            </select>
                        </div>                                               

                        <div class="form-group">
                            <label for="departamentoEscuela">Departamento/Escuela: <?php echo htmlentities($objProfesor->departamentoEscuela) ?></label>
                            <select class="form-control" name="departamentoEscuela" id="departamentoEscuela">
                                <option>Seleccione</option>
                                <?php
                                $opcionSeleccionada = $objProfesor->departamentoEscuela;
                                $seleccionado = "";
                                if ($opcionSeleccionada == "Escuela de computacion") {
                                    $seleccionado = "selected";
                                    ?>
                                    <option <?php echo $seleccionado ?>>Escuela de computacion</option>
                                    <option>Escuela de administracion</option>
                                    <?php
                                } elseif ($opcionSeleccionada == "Escuela de administracion") {
                                    $seleccionado = "selected";
                                    ?>
                                    <option>Escuela de computacion</option>
                                    <option <?php echo $seleccionado ?>>Escuela de administracion</option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="gradoAcademicoProfesor">Grado acad&eacute;mico: <?php echo htmlentities($objProfesor->gradoAcademicoProfesor) ?></label>
                            <select class="form-control" name="gradoAcademicoProfesor" id="gradoAcademicoProfesor">
                                <option>Seleccione</option>
                                <?php
                                $opcionSeleccionada = $objProfesor->gradoAcademicoProfesor;
                                $seleccionado = "";
                                if ($opcionSeleccionada == "Diplomado") {
                                    $seleccionado = "selected";
                                    ?>
                                    <option <?php echo $seleccionado ?>>Diplomado</option>
                                    <option>Bachiller</option>
                                    <option>Licenciado(a)</option>
                                    <option>Master</option>
                                    <option>Doctor(a)</option>
                                    <?php
                                } elseif ($opcionSeleccionada == "Bachiller") {
                                    $seleccionado = "selected";
                                    ?>
                                    <option>Diplomado</option>
                                    <option <?php echo $seleccionado ?>>Bachiller</option>
                                    <option>Licenciado(a)</option>
                                    <option>Master</option>
                                    <option>Doctor(a)</option>
                                    <?php
                                } elseif ($opcionSeleccionada == "Licenciado(a)") {
                                    $seleccionado = "selected";
                                    ?>
                                    <option>Diplomado</option>
                                    <option>Bachiller</option>
                                    <option <?php echo $seleccionado ?>>Licenciado(a)</option>
                                    <option>Master</option>
                                    <option>Doctor(a)</option>
                                    <?php
                                } elseif ($opcionSeleccionada == "Master") {
                                    $seleccionado = "selected";
                                    ?>
                                    <option>Diplomado</option>
                                    <option>Bachiller</option>
                                    <option>Licenciado(a)</option>
                                    <option <?php echo $seleccionado ?>>Master</option>
                                    <option>Doctor(a)</option>
                                    <?php
                                } elseif ($opcionSeleccionada == "Doctor(a)") {
                                    $seleccionado = "selected";
                                    ?>
                                    <option>Diplomado</option>
                                    <option>Bachiller</option>
                                    <option>Licenciado(a)</option>
                                    <option>Master</option>
                                    <option <?php echo $seleccionado ?>>Doctor(a)</option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cedula">C&eacute;dula: <?php echo htmlentities($objProfesor->cedula) ?></label>
                            <input type="text" class="form-control" name="cedula" id="cedula" value="<?php echo htmlentities($objProfesor->cedula) ?>">
                        </div>                   
                        <div class="form-group">
                            <label for="name">Nombre: <?php echo htmlentities($objProfesor->name) ?></label>
                            <input type="text" class="form-control" name="name" id="name" value="<?php echo htmlentities($objProfesor->name) ?>">
                        </div>                    
                        <div class="form-group">
                            <label for="lastname">Primer apellido: <?php echo htmlentities($objProfesor->apellido1) ?></label>
                            <input type="text" class="form-control" name="lastname" id="lastname" value="<?php echo htmlentities($objProfesor->apellido1) ?>">
                        </div>
                        <div class="form-group">
                            <label for="lastname">Segundo apellido: <?php echo htmlentities($objProfesor->apellido2) ?></label>
                            <input type="text" class="form-control" name="lastname2" id="lastname2" value="<?php echo htmlentities($objProfesor->apellido2) ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email: <?php echo htmlentities($objProfesor->email) ?></label>
                            <input type="email" class="form-control" name="email" id="email" value="<?php echo htmlentities($objProfesor->email) ?>">
                        </div>
                        <div class="form-group">
                            <label for="tel">Tel&eacute;fono: <?php echo htmlentities($objProfesor->tel) ?></label>
                            <input type="telephone" class="form-control" id="tel" name="tel" value="<?php echo htmlentities($objProfesor->tel) ?>">
                        </div>
                        <div class="form-group">
                            <label for="cel">Celular: <?php echo htmlentities($objProfesor->cel) ?></label>
                            <input type="telephone" class="form-control" id="cel" name="cel" value="<?php echo htmlentities($objProfesor->cel) ?>">
                        </div>
                        <div class="form-group">
                            <label for="jornadaLaboral">Jornada laboral: <?php echo htmlentities($objProfesor->jornada) ?></label>
                            <select class="form-control" name="jornadaLaboral" id="jornadaLaboral">
                                <option>Seleccione</option>
                                <?php
                                $opcionSeleccionada = $objProfesor->jornada;
                                if ($opcionSeleccionada) {
                                    $seleccionado = "";
                                    if ($opcionSeleccionada == "25%") {
                                        $seleccionado = "selected";
                                        ?>
                                        <option <?php echo $seleccionado ?>>25%</option>
                                        <option>50%</option>
                                        <option>100%</option>
                                        <option>120%</option>
                                        <option>133%</option>
                                        <?php
                                    } elseif ($opcionSeleccionada == "50%") {
                                        $seleccionado = "selected";
                                        ?>
                                        <option>25%</option>
                                        <option <?php echo $seleccionado ?>>50%</option>
                                        <option>100%</option>
                                        <option>120%</option>
                                        <option>133%</option>
                                        <?php
                                    } elseif ($opcionSeleccionada == "100%") {
                                        $seleccionado = "selected";
                                        ?>
                                        <option>25%</option>
                                        <option>50%</option>
                                        <option <?php echo $seleccionado ?>>100%</option>
                                        <option>120%</option>
                                        <option>133%</option>
                                        <?php
                                    } elseif ($opcionSeleccionada == "120%") {
                                        $seleccionado = "selected";
                                        ?>
                                        <option>25%</option>
                                        <option>50%</option>
                                        <option>100%</option>
                                        <option <?php echo $seleccionado ?>>120%</option>
                                        <option>133%</option>
                                        <?php
                                    } elseif ($opcionSeleccionada == "133%") {
                                        $seleccionado = "selected";
                                        ?>                                            
                                        <option>25%</option>
                                        <option>50%</option>
                                        <option>100%</option>
                                        <option>120%</option>
                                        <option <?php echo $seleccionado ?>>133%</option>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <option>25%</option>
                                    <option>50%</option>
                                    <option>100%</option>
                                    <option>120%</option>
                                    <option>133%</option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="direccion">Direcci&oacute;n: <?php echo htmlentities($objProfesor->direccion) ?></label>
                            <input type="text" class="form-control" name="direccion" id="direccion" value="<?php echo htmlentities($objProfesor->direccion) ?>">
                        </div>

                        <div class="form-group">
                            <label class="checkbox-inline"><input type="checkbox" id="chkPassword" name="chkPassword" value="" onclick="habilitarTextBox(this.checked, ['password','rePassword'])">¿Actualizar Contraseña?</label>
                        </div>

                        <div class="form-group">
                            <label for="pas">Password </label>
                            <input type="password" class="form-control" disabled="true" id="password" name="password" value="">
                        </div>
                        <div class="form-group">
                            <label for="rePas">Confirmar Password </label>
                            <input type="password" class="form-control" disabled="true" id="rePassword" name="rePassword" value="">
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