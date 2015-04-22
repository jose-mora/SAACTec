<div class="well well-lg" id="regSede">
    <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <?php
        if ($numeroRespuesta == 1) {
            echo '<div class="alert alert-danger" role="alert">
                      <p>La sede a registrar ya existe </p>
                      </div>';
        }
        elseif ($numeroRespuesta == 2) {

            echo '<div class="alert alert-danger" role="alert">
                    	<p>Se deben llenar todos los campos </p>
                  		</div>';
        }
        elseif ($numeroRespuesta == 3) {
            echo '<div class="alert alert-danger" role="alert">
                      <p>Error al registrar la sede </p>
                      </div>';
        }
        ?>
        <h3>Registro de sedes</h3>
        <div class="form-group">
            <label for="name">Nombre de la sede:</label>
            <input type="name" class="form-control" name="name" id="name">
            <input type="hidden" name="operation" name="operation" id="operation" value="sede_reg">	
        </div>
        <button type="submit" class="btn btn-primary">Registrar sede</button>
    </form>
</div>