<div class="well well-lg" id="modGrupo">
      		<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        	<?php
              
              if ($numeroRespuesta == 3) {
                echo '<div class="alert alert-danger" role="alert">
                      <p>Error al activar/desactivar el grupo</p>
                      </div>';
              } 
        	?>
        		<h3>Activar/Desactivar Grupos</h3>

            <table class="table table-condensed">
              <thead>
                <tr>
                  <th>Nombre de Grupo</th>
                  <th>Nombre del Curso</th>
                  <th>Sede</th>
                  <th>Horario</th>
                  <th>Acci&oacute;n</th>
                </tr>
              </thead>
              <tbody>

              <?php 
                $x = 1;
                $gruposArray = $controlador->retornarGruposCompleto();
                foreach ($gruposArray as $obj) :
          
                  if ($x == 1) {
                    $x=0;
                    echo '<tr class="info">';         
                  } else {
                    $x=1;
                    echo '<tr>';
                  }
                  
              ?>
             <td><?php echo $obj->ideGrupo; ?></td>
             <td><?php echo $obj->curso; ?></td>
             <td><?php echo $obj->sede; ?></td>
             <td><?php echo $obj->franja; ?></td>
             <?php
                if ($obj->activo == 1) {
              
              ?>
                  <td><?php echo "<a href='mantenimiento.php?grupoDes=". $obj->ideGrupo ."' class='btn btn-primary gestionBoton'> Desactivar </a> "; ?></td>
              <?php

                }else{

              ?>
                <td><?php echo "<a href='mantenimiento.php?grupoAct=". $obj->ideGrupo ."' class='btn btn-primary gestionBoton'> Activar </a> "; ?></td>
              <?php

                }
              ?>
              
              </tr>
              <?php endforeach; ?>
            
              </tbody>
              </table>
</div>