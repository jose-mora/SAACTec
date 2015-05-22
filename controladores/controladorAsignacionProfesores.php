<?php
  
	class controladorAsignacionProfesores {

          public function __construct() {
          }

          /************************
  
            Algoritmo de asignación

          /*************************/

          function asignarProfesores($obj){

            $controlador = new controladorBaseDatos(); 
            
            $listaGrupos = $controlador->retornarGruposActivos();

            foreach ($listaGrupos as $grupo){
              echo $grupo->ide; 

            }


            //retornarProfesoresActivosparaPreferenciasValidas

          }
                   
    }
          
?>