<?php
  
	class controladorResultadoProcAsignacion {

      public function __construct() {
      }

      function registrarResultadoProcAsignacion($idProcesoAsignacion, $ideGrupo, $email){
        $controlador = new controladorBaseDatos();             
        return $controlador->registrarResultadoProcAsignacion($idProcesoAsignacion, $ideGrupo, $email);
      }

      function eliminarResultadoProcAsignacion($idProcesoAsignacion){
        $controlador = new controladorBaseDatos(); 
        return $controlador->eliminarResultadoProcAsignacion($idProcesoAsignacion);
      }  
      
      function retornarResultadoProcAsignacion($idProcesoAsignacion){
        $controlador = new controladorBaseDatos(); 
        return $controlador->retornarResultadoProcAsignacion($idProcesoAsignacion);
      }  

    }
?>