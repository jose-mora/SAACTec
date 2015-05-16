<?php


  include('objetos/obj_sede.php');
  include('objetos/obj_grupo.php');
  include('objetos/obj_curso.php');
  include('objetos/obj_franja.php');
  //include('dataLayer/controladorBaseDatos.php');

	class controladorMantenimientos {

          public function __construct() {}


          /************************
  
            Operaciones con  sedes

          /*************************/

          //Metodo para registrar una sede en el sistema
          function registrarSede($nombreSede){

              if ( strlen( $nombreSede ) <= 0 ){ //si la sede está vacia no llega a base de datos
                return 2;
              }

              $controlador = new controladorBaseDatos(); //llamamos al controlador de base de datos
              $sedes = $controlador->retornarSedes(); //retornamos las sedes para ver si ya existe

              $insertar = true;

              for ($i=0; $i < (count($sedes)); $i++) { 
                
                $obj = $sedes[$i];//sacamos la sede

                if (strcasecmp($nombreSede, $obj->name) == 0 ) { //si la sede ya esta en base de datos quitamos el flag para insertar 
                  $insertar = false;
                  break;
                }
              }

              if ($insertar) { //si podemos insertar (no se encontro la sede)

                return $controlador->insertarSede($nombreSede);

              }else{
                return 1;
              }

          }

          function retornarSede($nombreSede){
              $controlador = new controladorBaseDatos(); 
              return $controlador->retornarSede($nombreSede);
          }

          function retornarSedes(){
              $controlador = new controladorBaseDatos(); //llamamos al controlador de base de datos
              return $controlador->retornarSedes(); //retornamos las sedes para ver si ya existe
          }

          function eliminarSede($sedeElim){

              $controlador = new controladorBaseDatos(); 
              return $controlador->eliminarSede($sedeElim); 
          }

          function gestionarSede($sedeGest,$valor){
              $controlador = new controladorBaseDatos();               
              return $controlador->gestionarSedes($sedeGest,$valor);   
          }

          function retornarSedesActivas(){
               $controlador = new controladorBaseDatos();               
              return $controlador->retornarSedesActivas(); 
          }

          /************************
  
            Operaciones con  franjas

          /*************************/

          //Metodo para registrar una franja en el sistema
          function registrarFranja($inicio,$fin,$dia){


              $numeroRespuesta =0;
              $nombreFranja = $dia. ": ". $inicio. " - ". $fin;

              $arrayInicio = explode(" ", $inicio);
              $arrayFin = explode(" ", $fin);

              $horaIncio = (int)$arrayInicio[0];
              $horaFin = (int)$arrayFin[0];

              if ($arrayInicio[1] == "pm") {    
                if ($arrayFin[1] == "am") { // y si la hora fin no es en la tarde
                  $numeroRespuesta = 2;

                }elseif ($horaIncio >= $horaFin) {// o si la es la tarde pero menor
                  $numeroRespuesta = 2;
                }

              }elseif ($arrayInicio[1] == "am") { //si es en la mañana
                if ($arrayFin[1] != "pm") { // y si la hora fin no es en la tarde
                  if ($horaIncio >= $horaFin) {
                    $numeroRespuesta = 2;
                  }
                }
              }

              if ($numeroRespuesta == 0) {

                $controlador = new controladorBaseDatos();
                $franjas = $controlador->retornarFranjas();
                $insertar = true;

                for ($i=0; $i < (count($franjas)); $i++) { 
                
                  $obj = $franjas[$i];//sacamos la sede

                  if (strcasecmp($nombreFranja, $obj->name) == 0 ) { //si la sede ya esta en base de datos quitamos el flag para insertar 
                    $insertar = false;
                    break;
                  }
                }

                if ($insertar) { //si podemos insertar (no se encontro la sede)
                  return $controlador->insertarFranja($nombreFranja);

                }else{
                  return 1;
                }

              }else{
                return $numeroRespuesta;
              }

          }

          function retornarFranjas(){
              $controlador = new controladorBaseDatos();               
              return $controlador->retornarFranjas();
          }

          function retornarFranja($nombreFranja){
              $controlador = new controladorBaseDatos();               
              return $controlador->retornarFranja($nombreFranja);
          }

          function gestionarFranja($franjaGest,$valor){

              $controlador = new controladorBaseDatos();               
              return $controlador->gestionarFranja($franjaGest,$valor); 
          }

          function retornarFranjasActivas(){
             $controlador = new controladorBaseDatos();               
              return $controlador->retornarFranjasActivas(); 
          }

           /************************
  
              Operaciones con  cursos

          /*************************/

          function registrarCurso($nombreCurso,$nivelCurso){

              if ( strlen( $nombreCurso ) <= 0 ){ 

                return 2;
              }

              $controlador = new controladorBaseDatos(); 
              $cursos = $controlador->retornarCursos(); 
              $insertar = true;

              for ($i=0; $i < (count($cursos)); $i++) { 
                
                $obj = $cursos[$i];

                if (strcasecmp($nombreCurso, $obj->name) == 0 ) { 
                  $insertar = false;
                  break;
                }
              }

              if ($insertar) { 

                return $controlador->insertarCurso($nombreCurso,$nivelCurso);

              }else{
                return 1;
              }
          }

          function retornarCurso($nombreCurso){
              $controlador = new controladorBaseDatos();               
              return $controlador->retornarCurso($nombreCurso);
          }

          function retornarCursos(){
              $controlador = new controladorBaseDatos();               
              return $controlador->retornarCursos();
          }

          function retornarCursosActivos(){
              $controlador = new controladorBaseDatos();               
              return $controlador->retornarCursosActivos();
          }
          

          function gestionarCurso ($cursoGest,$valor){

              $controlador = new controladorBaseDatos();               
              return $controlador->gestionarCurso($cursoGest,$valor);
          }

          
          /************************
  
            Operaciones con  grupos

          /*************************/
          function registrarGrupo($ideGrupo,$curso,$sede,$franja){
              

              if ( strlen( $ideGrupo ) <= 0 ){ 

                return 2;
              }

              $controlador = new controladorBaseDatos(); 
              $grupos = $controlador->retornarGrupos(); 
              $insertar = true;

              for ($i=0; $i < (count($grupos)); $i++) { 
                
                $obj = $grupos[$i];

                if (strcasecmp($ideGrupo, $obj->ideGrupo) == 0 ) { 
                  $insertar = false;
                  break;
                }
              }

              if ($insertar) { 

                $objSede = $controlador->retornarSede($sede);
                $objFranja = $controlador->retornarFranja($franja);
                $objCurso = $controlador -> retornarCurso($curso);

                return $controlador->registrarGrupo($ideGrupo,$objCurso->ide,$objSede->ide,$objFranja->ide);

              }else{
                return 1;
              }


              
         }

         function retornarGrupos(){
              $controlador = new controladorBaseDatos(); 
              return $controlador->retornarGrupos();
         }

         function gestionarGrupo($grupoGest,$valor){
              $controlador = new controladorBaseDatos(); 
              return $controlador->gestionarGrupo($grupoGest,$valor);
          }

          function retornarGruposConIDCurso($idCurso){

            $controlador = new controladorBaseDatos();
            return $controlador->retornarGruposConIDCurso($idCurso);
          }
    }
          
?>