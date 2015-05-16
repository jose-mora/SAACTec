<div class="well well-lg" id="regCurso">
      <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    	<?php
        		if ($numeroRespuesta == 2) {
                echo '<div class="alert alert-danger" role="alert">
                      <p>Se deben llenar todos los campos </p>
                      </div>';
              }elseif ($numeroRespuesta == 1) { 
                echo '<div class="alert alert-danger" role="alert">
                      <p>El Curso a registrar ya existe </p>
                      </div>';
              } elseif ($numeroRespuesta == 3) {
                echo '<div class="alert alert-danger" role="alert">
                      <p>Error al registrar el curso </p>
                      </div>';
              }  
      ?>
          <h3>Registro de Cursos</h3>
        	<div class="form-group">
        			<label for="name">Nombre Curso:</label>
        			<input type="name" class="form-control" name="name" id="name">

              <label for="nivel">Nivel Acad&eacute;mico:</label>
              <select class="form-control" name="nivel" id="nivel">
                <option>Bachillerato</option>
                <option>Licenciatura</option>
                <option>Maestria</option>
                <option>Doctorado</option>
              </select>
					    <input type="hidden" id="operation" name="operation" value="curso_reg">
        	</div>
        	<button type="submit" class="btn btn-primary">Registrar Curso</button>
      </form>
</div>