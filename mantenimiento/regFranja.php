<div class="well well-lg" id="regFranja">
      		<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        	<?php
              
              if ($numeroRespuesta == 2) {
                echo '<div class="alert alert-danger" role="alert">
                      <p>La hora final no puede ser menor a la hora inicial </p>
                      </div>';
              }elseif ($numeroRespuesta == 1) {
                echo '<div class="alert alert-danger" role="alert">
                      <p>La franja a registrar ya existe </p>
                      </div>';
              } elseif ($numeroRespuesta == 3) {
                echo '<div class="alert alert-danger" role="alert">
                      <p>Error al registrar la franja </p>
                      </div>';
              } 
        	?>
        		<h3>Registro de Franjas</h3>
        		<div class="form-group">

                <label for="sede">D&iacute;a:</label>
                <select class="form-control" name="franjaDia" id="franjaDia">
                  <option>Lunes</option>
                  <option>Martes</option>
                  <option>Miercoles</option>
                  <option>Jueves</option>
                  <option>Viernes</option>
                </select>

                <label for="sede">Inicio de Franja:</label>
                <select class="form-control" name="franjaInicio" id="franjaInicio">
                  <option>7 am</option>
                  <option>9 am</option>
                  <option>11 am</option>
                  <option>1 pm</option>
                  <option>3 pm</option>
                  <option>5 pm</option>
                  <option>7 pm</option>
                </select>

                <label for="sede">Fin de Franja:</label>
                <select class="form-control" name="franjaFin" id="franjaFin">
                  <option>9 am</option>
                  <option>11 am</option>
                  <option>1 pm</option>
                  <option>3 pm</option>
                  <option>5 pm</option>
                  <option>7 pm</option>
                  <option>9 pm</option>
                </select>

          			<input type="hidden" name="operation" id="operation" value="franja_reg">	
        		</div>
        		<button type="submit" class="btn btn-primary">Registrar Franja</button>
      		</form>
</div>