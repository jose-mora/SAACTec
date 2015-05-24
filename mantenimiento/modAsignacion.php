<div class="well well-lg">
    <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <h3>Activar/Desactivar Procesos de Asignación</h3>
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Proceso de Asignacion</th>
                    <th>Activar</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                $x = 1;
                $procesosArray = $controlador->retornarProcesosAsignacion();
                foreach ($procesosArray as $obj) :
          
                  if ($x == 1) {
                    $x=0;
                    echo '<tr class="info">';         
                  } else {
                    $x=1;
                    echo '<tr>';
                  }
            ?>
            <td><?php echo $obj->nombre; ?></td>
            <?php
                if ($obj->activo == 1) {
              
            ?>
                  <td><?php echo "<a href='gestionProcesosAsignacion.php?procesoDes=". $obj->nombre ."' class='btn btn-primary gestionBoton'> Desactivar </a> "; ?></td>
            <?php

                }else{

            ?>
                <td><?php echo "<a href='gestionProcesosAsignacion.php?procesoAct=". $obj->nombre ."' class='btn btn-primary gestionBoton'> Activar </a> "; ?></td>
            <?php

            }
            ?>
              
              </tr>
              <?php endforeach; ?>
            </tbody>
        </table>    
</div>