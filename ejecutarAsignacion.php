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
            $successFlag = FALSE;
            $typeOperation = '';
            $numeroRespuesta = 0;
            $errorType = '';
            include('dataLayer/controladorBaseDatos.php');
            include('controladores/controladorAsignacionProfesores.php');

            $controlador = new controladorAsignacionProfesores();
            
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $typeOperation = $_GET["etype"];
            }

            ?>

            <div>
                <h2> Asignación de Profesores </h2>
                <blockquote>
                    <p>Por favor espere a que el sistem termine de procesar los resultados</p>
                </blockquote>
            </div>	
            </br>  

            <div class="well well-lg">
                <div class="container-fluid" align="center">


               <!--  TESTEANDO LA CONSULTA DE DEVOLUCIÓN, 
               SE SUPONE QUE SE DEBE CORRER ESTE FRAGMENTO UNA VEZ TERMINADO EL ALGORITMO -->

                <?php
                //TESTEANDO LA INSERSIÓN

                include('controladores/controladorResultadoProcAsignacion.php');
                $controladoroInserc = new controladorResultadoProcAsignacion();
                $resulinserc = $controladoroInserc->registrarResultadoProcAsignacion($typeOperation,'ECD1','jmendezb88@yahoo.com');
                $resulinserc = $controladoroInserc->registrarResultadoProcAsignacion($typeOperation,'GrupoMendez','elizondo1288@gmail.com');
                $resulinserc = $controladoroInserc->registrarResultadoProcAsignacion($typeOperation,'ECD2','elizondo1288@gmail.com');
                //Activar el ejecutado de la insercion
                include('controladores/controladorProcesosAsignacion.php');
                include('objetos/obj_procesoAsignacion.php');
                $controlador = new controladorProcesosAsignacion();
                $numeroRespuesta = $controlador->ejecutarProcesosAsignacion($typeOperation, 1);

                ?>

                <table class="table table-condensed">
                  <thead>
                    <tr>
                      <th>Proceso Asignacion</th>
                      <th>Sede</th>
                      <th>Curso</th>
                      <th>Grupo</th>
                      <th>Franja</th>
                      <th>Profesor</th>
                    </tr>
                  </thead>
                  <tbody>

                  <?php 
                    
                    
                    include('objetos/obj_resultadoProcAsignacion.php');
                    $controladorResul = new controladorResultadoProcAsignacion();
                    $resulArray = $controladorResul->retornarResultadoProcAsignacion($typeOperation);
                    $x = 1;

                    foreach ($resulArray as $obj) :
              
                      if ($x == 1) {
                        $x=0;
                        echo '<tr class="info">';         
                      } else {
                        $x=1;
                        echo '<tr>';
                      }
                      
                  ?>
                  <td><?php echo $obj->procesoAsignacion; ?></td>
                  <td><?php echo $obj->sede; ?></td>
                  <td><?php echo $obj->curso; ?></td>
                  <td><?php echo $obj->ideGrupo; ?></td>
                  <td><?php echo $obj->franja; ?></td>
                  <td><?php echo $obj->profesor; ?></td>
                  
                  </tr>
                  <?php endforeach; ?>
                
                  </tbody>
                </table>

                <!--  FIN DEL TEST: Resultado Aprobado -->
                    
                </div>
            </div>  

        </div>

        <script src="js/functions.js"></script> 
        <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>


