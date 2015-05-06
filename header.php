<?php

  $rolUser = 'profesor';
  $loggedHeader = false;

  if (isset($_SESSION['logged_user'])) {

      $loggedHeader = true;

      //echo " ". $_SESSION['logged_user'];

      $arrayInfo = explode(" ", $_SESSION['logged_user']);

      $rolUser = $arrayInfo[1];

      //echo "  ROL:  ". $rolUser;

  }

?>


		<div class="page-header">
			<a class="navbar-brand" href="index.php">
              <img class="img-responsive" height="40px" width="40px" src="img/logoModelos2.png">
    		</a>
			<h1>SAACTec!</h1>
		</div>

		<nav class="navbar navbar-inverse navbar-custom navbar-static-top">
  			<div class="container-fluid">
  			<ul class="nav navbar-nav navbar-right">

          <?php

            if ($loggedHeader) {

              if ($rolUser == 'Administrador') {      
  
          ?>

        		<li><a href="profesores.php"><p class="nb"> Profesores </p></a></li>
        			
        		<li><a href="mantenimiento.php"><p class="nb"> Mantenimientos </p></a></li>

        		<li><a href="preferenciasBuscarProfesor.php"><p class="nb">Preferencias</p></a></li>
 
        		<li><a href="reportes.php"><p class="nb">Reportes</p></a></li>

        		<li><a href="underConstruction.php"><p class="nb">Asignar Cargas</p></a></li>

            <li><a href="acercaDe.php"><p class="nb">Acerca de</p></a></li>
            
            <li><a href="logout.php"><p class="nb">Salir</p></a></li>
          <?php

              }else{ //no es tipo super, es profesor

          ?>
            <li><a href="profesores.php"><p class="nb"> Profesores </p></a></li>
            <li><a href="acercaDe.php"><p class="nb">Acerca de</p></a></li>
            <li><a href="logout.php"><p class="nb">Salir</p></a></li>

          <?php    

              }
            }else{

          ?>
            <li><a href="login.php"><p class="nb">Login</p></a></li>

        		<li><a href="acercaDe.php"><p class="nb">Acerca de</p></a></li>

            <?php
            }
          ?>
        	</ul>
  			</div>
  		</nav>

		<script type="text/javascript">
			
			function goMain(){
				window.location.href = "index.php";
			}

		</script>

		