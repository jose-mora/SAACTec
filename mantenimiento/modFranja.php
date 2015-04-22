<div class="well well-lg" id="modFranja">
      		<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        	<?php
              
              if ($numeroRespuesta == 3) {
                echo '<div class="alert alert-danger" role="alert">
                      <p>Error al activar/desactivar la franja</p>
                      </div>';
              } 
        	?>
        		<h3>Activar/Desactivar Franjas</h3>

            <table class="table table-condensed">
              <thead>
                <tr>
                  <th>Nombre de Franja</th>
                  <!-- <th>D&iacute;a</th> -->  
                  <th>Acci&oacute;n</th>
                </tr>
              </thead>
              <tbody>

              <?php 
                $x = 1;
                $fArray = $controlador->retornarFranjas();
                foreach ($fArray as $obj) :
          
                  if ($x == 1) {
                    $x=0;
                    echo '<tr class="info">';         
                  } else {
                    $x=1;
                    echo '<tr>';
                  }
                  
              ?>
              <td><? echo $obj->name; ?></td>
             <!-- <td><? //echo $obj->dia; ?></td> -->
             <?php
                if ($obj->activo == 1) {
              
              ?>
                  <td><? echo "<a href='mantenimiento.php?franjaDes=". $obj->name ."' class='btn btn-primary gestionBoton'> Desactivar </a> "; ?></td>
              <?php

                }else{

              ?>
                <td><? echo "<a href='mantenimiento.php?franjaAct=". $obj->name ."' class='btn btn-primary gestionBoton'> Activar </a> "; ?></td>
              <?php

                }
              ?>
              
              </tr>
              <?php endforeach; ?>
            
              </tbody>
              </table>
</div>