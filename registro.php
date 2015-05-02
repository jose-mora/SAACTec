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
        <script src="js/functions.js"></script> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php
        header('Content-Type: text/html; charset=UTF-8');
        ?>

    </head>
    <body>
        <div class="container">
            <?php ?>
            <?php
            session_start();
            include("header.php");

            if (!$loggedHeader) {
                header('Location: ../Asignacion/index.php');
            }

            $validateFlag = FALSE;
            $successFlag = FALSE;
            $emptyAmmount = 0;

            include('objetos/obj_profesor.php');
            include('controladores/controladorProfesores.php');
            $controlador = new controladorProfesores();


            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
                //$notas = test_input($_POST["notas"]);                           
                
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
                /*if (strlen($notas) <= 0) {
                    $validateFlag = TRUE;
                    $emptyAmmount++;
                }*/

                if (!$validateFlag) { //if the validation passes
                    $prof = new obj_profesor($tipoProfesor, $departamentoEscuela, $gradoAcademicoProfesor, $cedula, $username, $lastname, $lastname2, 
                            $email, $tel, $cel, $jornadaLaboral, $direccion/*, $notas*/);
                    $resultado = $controlador->registrarProfesores($prof);


                    if ($resultado > 0) {
                        $validateFlag = TRUE;
                        $successFlag = FALSE;
                    } else {
                        $validateFlag = FALSE;
                        $successFlag = TRUE;
                    }

                    //$_SESSION['profesor']= $prof;
                    //header('Location: ../Asignacion/profesores.php');   
                } else {

                    //empty fields detected
                    //if its 13, all of the fields were empty, so the user is reaching the screen
                    if ($emptyAmmount == 13) {
                        $validateFlag = FALSE;
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
                <blockquote>
                    <p>Secci&oacute;n de registro de profesores, por favor ingresar los datos solicitados</p>
                </blockquote>
            </div>	
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
                    <h3>Registro de profesores</h3>
                    <div class="form-group">
                        <label for="tipoProfesor">Tipo de profesor:</label>
                        <select class="form-control" name="tipoProfesor" id="tipoProfesor">
                            <option>Seleccione</option>
                            <option>Con plaza</option>
                            <option>Interino</option>                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="departamentoEscuela">Departamento/Escuela:</label>
                        <select class="form-control" name="departamentoEscuela" id="departamentoEscuela">
                            <option>Seleccione</option>
                            <option>Escuela de computaci&oacute;n</option>
                            <option>Escuela de administraci&oacute;n</option>                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="gradoAcademicoProfesor">Grado acad&eacute;mico:</label>
                        <select class="form-control" name="gradoAcademicoProfesor" id="gradoAcademicoProfesor">
                            <option>Seleccione</option>
                            <option>Diplomado</option>
                            <option>Bachiller</option>
                            <option>Licenciado(a)</option>
                            <option>M&aacute;ster</option>
                            <option>Doctor(a)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cedula">C&eacute;dula:</label>
                        <input type="text" class="form-control" name="cedula" id="cedula">
                    </div>                   
                    <div class="form-group">
                        <label for="name">Nombre:</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>                    
                    <div class="form-group">
                        <label for="lastname">Primer apellido:</label>
                        <input type="text" class="form-control" name="lastname" id="lastname">
                    </div>
                    <div class="form-group">
                        <label for="lastname">Segundo apellido:</label>
                        <input type="text" class="form-control" name="lastname2" id="lastname2">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" id="email">
                    </div>
                    <div class="form-group">
                        <label for="tel">Tel&eacute;fono:</label>
                        <input type="telephone" class="form-control" id="tel" name="tel">
                    </div>
                    <div class="form-group">
                        <label for="cel">Celular:</label>
                        <input type="telephone" class="form-control" id="cel" name="cel">
                    </div>
                    <div class="form-group">
                        <label for="jornadaLaboral">Jornada laboral:</label>
                        <select class="form-control" name="jornadaLaboral" id="jornadaLaboral">
                            <option>Seleccione</option>
                            <option>25%</option>
                            <option>50%</option>
                            <option>100%</option>
                            <option>120%</option>
                            <option>133%</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="direccion">Direcci&oacute;n:</label>
                        <input type="text" class="form-control" name="direccion" id="direccion">
                    </div>

                    <button type="button" class="btn btn-primary" onclick="goBack();"> Atr&aacute;s </button>
                    <button type="submit" class="btn btn-primary">Registrar</button>

                </form>

            </div>
        </div>

    </div>

</body>
</html>