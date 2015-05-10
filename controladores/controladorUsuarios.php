<?php

  include('dataLayer/controladorBaseDatos.php');
  
	class controladorUsuarios {

          public function __construct() {
          }

          /************************
  
            Operaciones con Usuarios

          /*************************/

          function registrarUsuario($obj){
            $controlador = new controladorBaseDatos(); 
            $usuario = $obj->usuario;
            $contrasena = $obj->contrasena;
            $tipoUsuario = $obj->tipoUsuario;
            return $controlador->registrarUsuario($usuario,$contrasena,$tipoUsuario);
          }

          function actualizarContrasena($passwd,$emailOri){
            $controlador = new controladorBaseDatos(); 
            return $controlador->actualizarContrasena($passwd,$emailOri);
          }

          function actualizarUsuario($email,$emailOri){
            $controlador = new controladorBaseDatos(); 
            return $controlador->actualizarUsuario($email,$emailOri);
          }

          function retornarUsuario($usuario,$contrasena,$tipoUsuario){
            $controlador = new controladorBaseDatos(); 
            return $controlador->retornarUsuario($usuario,$contrasena,$tipoUsuario);
          }                   
    }
          
?>