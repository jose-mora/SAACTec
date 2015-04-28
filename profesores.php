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

            include('objetos/obj_profesor.php');
            include('controladores/controladorProfesores.php');
            $controlador = new controladorProfesores();


            //if ($_SERVER['REQUEST_METHOD'] == 'POST') sirve para ver si llego un metodo de request y con un post


            /* if (isset($_SESSION['profesor'])) {
              //echo "entro";  --> esto sirve para probar si entro al if y demás

              $profLast =  $_SESSION['profesor'];
              //we add the user from the other page to this one
              $shop[] = $profLast;

              unset($_SESSION['profesor']); //remove the profesor object from session
              } */
            ?>
            <div>
                <h2> Profesores </h2>


                <?php
                if ($loggedHeader) {

                    if ($rolUser == 'super') {
                        ?>

                        <blockquote>
                            <p>A continuaci&oacute;n se muestra la lista de los profesores registrados en el sistema junto con informaci&oacute;n de
                                contacto del mismo. Si el profesor a buscar no se encuentra en la lista, por favor registrarlo en el Sistema de Asignaci&oacute;n de Cargas</p>
                        </blockquote>
                    </div>	
                    </br>

                    <div align="center">
                        <div class="btn-group btn-group-lg">
                            <a href="gestionProfesores.php" class="btn btn-primary"> Buscar Profesor </a>
                            <a href="registro.php" class="btn btn-primary"> Registro Profesor </a> 	
                        </div>	
                    </div>

                    <?php
                }
            }
            ?>

            </br></br></br>
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
        </div>

    </div>

</body>
</html>