<?php

/**
 * Clase para el mantenimiento de profesores
 */
class controladorPreferencias {

    function __construct() {
        
    }
    

    function registrarPreferencia($email,$grupo,$nivel){

        $cont = new controladorBaseDatos();
        return $cont->registrarPreferencia($email,$grupo,$nivel);
        
    }

    function eliminarPreferencia($ideGrupo,$email,$rank){
        
        $cont = new controladorBaseDatos();
        return $cont->eliminarPreferencia($ideGrupo,$email,$rank);
        
    }

    function cantidadA($email){

        $cont = new controladorBaseDatos();
        return $cont->cantidadA($email);
    }

    function cantidadBC($email){
        $cont = new controladorBaseDatos();
        return $cont->cantidadBC($email);   
    }

    function retornarPreferenciasProfesor($email){

        $cont = new controladorBaseDatos();
        return $cont->retornarPreferenciasProfesor($email);
    }

    function gestionarPreferencias($email,$valor){
        $cont = new controladorBaseDatos();
        $result = $cont->gestionarPreferencias($email,$valor);
    }

}

?>