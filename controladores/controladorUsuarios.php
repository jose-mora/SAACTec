<?php

  include('dataLayer/controladorBaseDatos.php');

	class controladorUsuarios {

          public function __construct() {}


          /************************
  
            Operaciones con Usuarios

          /*************************/

          //Metodo para registrar una sede en el sistema
          function registrarUsuario($tipoUsuario, $usuario, $contrasena){

              if ( strlen( $usuario ) <= 0 ){ //si el usuario (correo) está vacia no llega a base de datos
                return 2;
              }

              if ( strlen( $contrasena ) <= 0 ){ //si la contrasena está vacia no llega a base de datos
                return 2;
              }

              // $controlador = new controladorBaseDatos(); //llamamos al controlador de base de datos
              // $sedes = $controlador->retornarSedes(); //retornamos las sedes para ver si ya existe

              // $insertar = true;

              // for ($i=0; $i < (count($sedes)); $i++) { 
                
              //   $obj = $sedes[$i];//sacamos la sede

              //   if (strcasecmp($nombreSede, $obj->name) == 0 ) { //si la sede ya esta en base de datos quitamos el flag para insertar 
              //     $insertar = false;
              //     break;
              //   }
              // }

              // if ($insertar) { //si podemos insertar (no se encontro la sede)

              //   return $controlador->insertarSede($nombreSede);

              // }else{
              //   return 1;
              // }

          }

          function retornarUsuario($usuario,$contrasena,$tipoUsuario){
              $controlador = new controladorBaseDatos(); 
              return $controlador->retornarUsuario($usuario,$contrasena,$tipoUsuario);
          }                   
    }
          
?>