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
                    if (!checkBool) {
                        textFldObj.value = '';
                    }
                }
                ;
            }
        </script>

        <div class="container">

            <?php
            session_start(); //importante arrancar el session luego de incluir los objetos, sino tira un error que no conoce el objeto a crear

            include("header.php");

            if (!$loggedHeader) {
                header('Location: ../Asignacion/index.php');
            }

            include('objetos/obj_profesor.php');
            include('controladores/controladorProfesores.php');

            include('objetos/obj_usuario.php');
            include('controladores/controladorUsuarios.php');

            include('objetos/obj_nota.php');
            include('controladores/controladorHistoricoNotas.php');

            $controlador = new controladorProfesores();
            $controladorUsuario = new controladorUsuarios();
            $controladorNotas = new controladorHistoricoNotas();

            //include('controladores/controladorEvaluaciones.php');
            //$controladorEv = new controladorEvaluaciones();

            $validateFlag = FALSE;
            $validateFlagPswd = FALSE;
            $successFlag = FALSE;
            $mostrarLista = false;
            $emptyAmmount = 0;

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $operation = $_POST["operation"];

                if ($operation == "prof_actualizar") {  //si es actualizar profesor
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
                        if ((strlen($passwd) <= 0) || (strlen($rePasswd) <= 0)) {
                            $validateFlag = TRUE;
                            $emptyAmmount++;
                        } else {
                            if (strcmp($passwd, $rePasswd) != 0) {
                                $validateFlag = TRUE;
                                $validateFlagPswd = TRUE;
                            }
                        }
                    }

                    if (!$validateFlag) { //if the validation passes
                        $prof = new obj_profesor($tipoProfesor, $departamentoEscuela, $gradoAcademicoProfesor, $cedula, $username, $lastname, $lastname2, $email, $tel, $cel, $jornadaLaboral, $direccion);
                        $resultado = $controlador->actualizarProfesor($prof, $emailOri);

                        if ($resultado == 12) {
                            echo '<div class="alert alert-danger" role="alert">
                            <p>Esta dirección de correo ya existe, se canceló la actualización</p>
                            </div>';
                        } else {
                            $successFlag = TRUE;

                            //Si cambia la contraseña
                            if (isset($_POST['chkPassword'])) {
                                $resultado = $controladorUsuario->actualizarContrasena($passwd, $emailOri);
                            }

                            //Si es cambio de correo (username)
                            if (strcmp($email, $emailOri) != 0) {
                                $resultado = $controladorUsuario->actualizarUsuario($email, $emailOri);
                                echo "<script type='text/javascript'> 
                                        alert('Se desconectará la sesión, su usuario ha cambiado');
                                        window.location='logout.php';
                                     </script>";
                            }
                        }
                    } else {

                        //OJO REVISAR SI SE DEBE CAMBIAR A 13
                        if ($emptyAmmount == 12) {
                            $validateFlag = FALSE;
                        }
                    }
                }
            }

            function test_input($data) {//clean the data from the fields
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);

                return $data;
            }

            /* if (isset($_SESSION['profesor'])) {
              //echo "entro";  --> esto sirve para probar si entro al if y demás

              $profLast =  $_SESSION['profesor'];
              //we add the user from the other page to this one
              $shop[] = $profLast;

              unset($_SESSION['profesor']); //remove the profesor object from session
              } */
            ?>
            <?php
            if ($loggedHeader) {
                if ($rolUser == 'Administrador') {
                    ?>
                    <div>
                        <h2> Profesores </h2>
                        <blockquote>
                            <p>A continuaci&oacute;n se muestra la lista de los profesores registrados en el sistema junto con informaci&oacute;n de
                                contacto del mismo. Si el profesor a buscar no se encuentra en la lista, por favor registrarlo en el Sistema de Asignaci&oacute;n de Cargas</p>
                        </blockquote>
                    </div>
                    </br>

                    <div align="center">
                        <div class="btn-group btn-group-lg">
                            <a href="gestionProfesores.php" class="btn btn-primary"> Buscar </a>
                            <a href="registro.php" class="btn btn-primary"> Registro </a>
                        </div>
                    </div>

                    </br></br>

                    <div>
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th class="hidden-xs hidden-sm">Apellido</th>
                                    <th class="hidden-xs">Email</th>
                                    <th class="hidden-xs hidden-sm">Telefono</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $shop = $controlador->retornarProfesoresActivos();
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
                                <td><?php echo $obj->name; ?></td>
                                <td><?php echo $obj->apellido1; ?></td>
                                <td class="hidden-xs hidden-sm"><?php echo $obj->apellido2; ?></td>
                                <td class="hidden-xs"><?php echo $obj->email; ?></td>
                                <td class="hidden-xs hidden-sm"><?php echo $obj->tel; ?></td>
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>

                    <?php
                } else {
                    $arrayInfo = explode(" ", $_SESSION['logged_user']);
                    $usuario = $arrayInfo[0];
                    $objProfesor = $controlador->retornarProfesor($usuario);
                    $idProfesor = $objProfesor->ide;
                    $_SESSION['profesor'] = $idProfesor;
                    $shop = $controladorNotas->retornarNotas($idProfesor);

                    if (count($shop) >= 1) {
                        $mostrarLista = true;
                    }
                    ?>

                    <h2> Bienvenido  <?php echo htmlentities($objProfesor->name) ?>  <?php echo htmlentities($objProfesor->apellido1) ?></h2>
                    <div class="well well-lg">
                        <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

                            <?php
                            if ($validateFlag == TRUE && $validateFlagPswd == FALSE) {
                                echo '<div class="alert alert-danger" role="alert">
                    <p>Se deben llenar todos los campos </p>
                    </div>';
                            }

                            if ($validateFlagPswd) {
                                echo '<div class="alert alert-danger" role="alert">
                        <p>Las contraseñas no coinciden </p>
                        </div>';
                            }

                            if ($successFlag) {
                                echo '<div class="alert alert-success" role="alert">
                    <p>Profesor actualizado con &eacute;xito </p>
                  </div>';
                                $successFlag = FALSE;
                            }
                            ?>
                            <h3>Información Actual</h3>

                            <div class="form-group">
                                <label for="name">Nombre: <?php echo htmlentities($objProfesor->name) ?></label>
                                <input type="text" class="form-control" name="name" id="name" value="<?php echo htmlentities($objProfesor->name) ?>">
                            </div>
                            <div class="form-group">
                                <label for="lastname">Primer Apellido: <?php echo htmlentities($objProfesor->apellido1) ?></label>
                                <input type="text" class="form-control" name="lastname" id="lastname" value="<?php echo htmlentities($objProfesor->apellido1) ?>">
                            </div>
                            <div class="form-group">
                                <label for="lastname">Segundo Apellido: <?php echo htmlentities($objProfesor->apellido2) ?></label>
                                <input type="text" class="form-control" name="lastname2" id="lastname2" value="<?php echo htmlentities($objProfesor->apellido2) ?>">
                            </div>

                            <div class="form-group">
                                <label for="cedula">C&eacute;dula: <?php echo htmlentities($objProfesor->cedula) ?></label>
                                <input type="text" class="form-control" name="cedula" id="cedula" value="<?php echo htmlentities($objProfesor->cedula) ?>">
                            </div> 

                            <div class="form-group">
                                <label for="email">Email: <?php echo htmlentities($objProfesor->email) ?></label>
                                <input type="email" class="form-control" name="email" id="email" value="<?php echo htmlentities($objProfesor->email) ?>">
                            </div>
                            <div class="form-group">
                                <label for="tel">Telefono: <?php echo htmlentities($objProfesor->tel) ?></label>
                                <input type="telephone" class="form-control" id="tel" name="tel" value="<?php echo htmlentities($objProfesor->tel) ?>">
                            </div>
                            <div class="form-group">
                                <label for="tel">Celular: <?php echo htmlentities($objProfesor->cel) ?></label>
                                <input type="telephone" class="form-control" id="cel" name="cel" value="<?php echo htmlentities($objProfesor->cel) ?>">
                            </div>
                            <div class="form-group">
                                <label for="tel">Direcci&oacute;n: <?php echo htmlentities($objProfesor->direccion) ?></label>
                                <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo htmlentities($objProfesor->direccion) ?>">
                            </div>

                            <div class="form-group">
                                <label for="sede">Jornada Laboral:  <?php echo htmlentities($objProfesor->jornada) ?></label>
                                <select class="form-control" name="jornadaLaboral" id="jornadaLaboral">
                                    <option>25%</option>
                                    <option>50%</option>
                                    <option>100%</option>
                                    <option>133%</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sede">Nivel Acad&eacute;mico:  <?php echo htmlentities($objProfesor->gradoAcademicoProfesor) ?></label>
                                <select class="form-control" name="gradoAcademicoProfesor" id="gradoAcademicoProfesor">
                                    <option>Bachiller</option>
                                    <option>Licenciado</option>
                                    <option>Master</option>
                                    <option>Doctorado</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tipoProfesor">Tipo de profesor: <?php echo htmlentities($objProfesor->tipoProfesor) ?></label>
                                <select class="form-control" name="tipoProfesor" id="tipoProfesor">
                                    <option>Con plaza</option>
                                    <option>Interino</option>                            
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="departamentoEscuela">Departamento/Escuela:   <?php echo htmlentities($objProfesor->departamentoEscuela) ?></label>
                                <select class="form-control" name="departamentoEscuela" id="departamentoEscuela">
                                    <option>Escuela de computaci&oacute;n</option>
                                    <option>Escuela de administraci&oacute;n</option>                            
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="checkbox-inline"><input type="checkbox" id="chkPassword" name="chkPassword" value="" onclick="habilitarTextBox(this.checked, ['password', 'rePassword'])">¿Actualizar Contraseña?</label>
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
                    </div>
                    <?php
                    if ($mostrarLista) {
                        ?>
                        <div class="well well-lg">
                            <h3>&Uacute;ltimas Evaluaciones</h3>
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <th>Nota</th>
                                        <th>Per&iacute;odo</th>
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
                                    </tr>                                    
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php
                        }
                        ?>
                    </div>
                    <br/>

                    <?php
                }
            }
            ?>
        </div>
    </body>
</html>