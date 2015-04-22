<div class="well well-lg" id="modCurso">
        	<?php
              
              if ($numeroRespuesta == 3) {
                echo '<div class="alert alert-danger" role="alert">
                      <p>Error al activar/desactivar la sede </p>
                      </div>';
              } 
        	?>
        		<h3>Activar/Desactivar Cursos</h3>

            <table class="table table-condensed">
              <thead>
                <tr>
                  <th>Nombre de Curso</th>
                  <th>Nivel de Curso</th>
                  <th>Acci&oacute;n</th>
                </tr>
              </thead>
              <tbody>

              <?php 
                $x = 1;
                $cursosArray = $controlador->retornarCursos();
                foreach ($cursosArray as $obj) :
          
                  if ($x == 1) {
                    $x=0;
                    echo '<tr class="info">';         
                  } else {
                    $x=1;
                    echo '<tr>';
                  }
              ?>
              <td><? echo $obj->name; ?></td>
              <td><? echo $obj->nivel; ?></td>

              <?php
                if ($obj->activo == 1) {
              
              ?>
                  <td><? echo "<a href='mantenimiento.php?cursoDes=". $obj->name ."' class='btn btn-primary gestionBoton'> Desactivar </a> "; ?></td>
              <?php

                }else{

              ?>
                <td><? echo "<a href='mantenimiento.php?cursoAct=". $obj->name ."' class='btn btn-primary gestionBoton'> Activar </a> "; ?></td>
              <?php

                }
              ?>
               
              </tr>
              <?php endforeach; ?>
            
              </tbody>
              </table>
</div>