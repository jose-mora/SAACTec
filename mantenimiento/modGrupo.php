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
                  <th>Acci&oacute;n</th>
                </tr>
              </thead>
              <tbody>

              <?php 
                $x = 1;
                $gruposArray = $controlador->retornarGrupos();
                foreach ($gruposArray as $obj) :
          
                  if ($x == 1) {
                    $x=0;
                    echo '<tr class="info">';         
                  } else {
                    $x=1;
                    echo '<tr>';
                  }
                  
              ?>
              <td><? echo $obj->ideGrupo; ?></td>
             <?php
                if ($obj->activo == 1) {
              
              ?>
                  <td><? echo "<a href='mantenimiento.php?grupoDes=". $obj->ideGrupo ."' class='btn btn-primary gestionBoton'> Desactivar </a> "; ?></td>
              <?php

                }else{

              ?>
                <td><? echo "<a href='mantenimiento.php?grupoAct=". $obj->ideGrupo ."' class='btn btn-primary gestionBoton'> Activar </a> "; ?></td>
              <?php

                }
              ?>
              
              </tr>
              <?php endforeach; ?>
            
              </tbody>
              </table>
</div>