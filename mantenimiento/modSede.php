<div class="well well-lg" id="modSede">
      		<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        	<?php
              
              if ($numeroRespuesta == 3) {
                echo '<div class="alert alert-danger" role="alert">
                      <p>Error al activar/desactivar la sede</p>
                      </div>';
              } 
        	?>
        		<h3>Activar/Desactivar Sedes</h3>

            <table class="table table-condensed">
              <thead>
                <tr>
                  <th>Nombre de Sede</th>
                  <th>Acci&oacute;n</th>
                </tr>
              </thead>
              <tbody>

              <?php 
                $x = 1;
                $sedesArray = $controlador->retornarSedes();
                foreach ($sedesArray as $obj) :
          
                  if ($x == 1) {
                    $x=0;
                    echo '<tr class="info">';         
                  } else {
                    $x=1;
                    echo '<tr>';
                  }
                  
              ?>
              <td><?php echo $obj->name; ?></td>
             <?php
                if ($obj->activo == 1) {
              
              ?>
                  <td><?php echo "<a href='mantenimiento.php?sedeDes=". $obj->name ."' class='btn btn-primary gestionBoton'> Desactivar </a> "; ?></td>
              <?php

                }else{

              ?>
                <td><?php echo "<a href='mantenimiento.php?sedeAct=". $obj->name ."' class='btn btn-primary gestionBoton'> Activar </a> "; ?></td>
              <?php

                }
              ?>
              
              </tr>
              <?php endforeach; ?>
            
              </tbody>
              </table>
</div>