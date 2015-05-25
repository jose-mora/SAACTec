<?php
  
	class controladorProcesosAsignacion {

          public function __construct() {
          }

          function registrarProcesoAsignacion($nombre){
            $controlador = new controladorBaseDatos();             
            return $controlador->registrarProcesoAsignacion($nombre);
          }

          function activarProcesosAsignacion($nombre,$activo){
            $controlador = new controladorBaseDatos(); 
            return $controlador->activarProcesosAsignacion($nombre,$activo);
          }  

          function ejecutarProcesosAsignacion($idProcesoAsignacion,$ejecutar){
            $controlador = new controladorBaseDatos(); 
            return $controlador->ejecutarProcesosAsignacion($idProcesoAsignacion,$ejecutar);
          }  

          function retornarProcesosAsignacion(){
            $controlador = new controladorBaseDatos(); 
            return $controlador->retornarProcesosAsignacion();
          }  

          function retornarProcesosAsignacionActivos(){
            $controlador = new controladorBaseDatos(); 
            return $controlador->retornarProcesosAsignacionActivos();
          } 

          function retornarProcesosAsignacionxNombre($nombre){
            $controlador = new controladorBaseDatos(); 
            return $controlador->retornarProcesosAsignacionxNombre($nombre);
          } 

    }
?>