<div class="well well-lg" id="regGrupo">
      <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    	<?php

        		if ($numeroRespuesta == 2) {
                echo '<div class="alert alert-danger" role="alert">
                      <p>Se deben llenar todos los campos </p>
                      </div>';
              }elseif ($numeroRespuesta == 1) {
                echo '<div class="alert alert-danger" role="alert">
                      <p>El grupo a registrar ya existe </p>
                      </div>';
              } elseif ($numeroRespuesta == 3) {
                echo '<div class="alert alert-danger" role="alert">
                      <p>Error al registrar el grupo </p>
                      </div>';
              }   

      ?>
          <h3>Registro de Grupos</h3>
        	<div class="form-group">
        			<label for="name">Identificador Grupo:</label>
        			<input type="name" class="form-control" name="ideGrupo" id="ideGrupo">


              <label for="curso">Curso:</label>
              <select class="form-control" name="curso" id="curso">
                <?php

                $cursosArray = $controlador->retornarCursosActivos();
                for ($i=0; $i < (count($cursosArray)); $i++) { 
                  echo "<option>".$cursosArray[$i]->name."</option>";
                }

                ?>
              </select> 

              <label for="franja">Horario del grupo:</label>
              <select class="form-control" name="franja" id="franja">
                <?php

                $franjasArray = $controlador->retornarFranjasActivas();
                for ($i=0; $i < (count($franjasArray)); $i++) { 
                      echo "<option>".$franjasArray[$i]->name."</option>";
                }

              ?>
              </select>

              <label for="sede">Sedes Activas:</label>
              <select class="form-control" name="sede" id="sede">
                <?php

                $sedesArray = $controlador->retornarSedesActivas();
                for ($i=0; $i < (count($sedesArray)); $i++) { 
                      echo "<option>".$sedesArray[$i]->name."</option>";
                }

              ?>
              </select>

          		
              

              

					     <input type="hidden" id="operation" name="operation" value="grupo_reg">
        	</div>
        	<button type="submit" class="btn btn-primary">Registrar Curso</button>
      </form>
</div>